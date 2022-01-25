<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\User;
use App\Models\Profil;
use App\Models\MataKuliah;
use App\Models\Krs;
use App\Models\DosenNidn;
use App\Models\DosenJson;
use App\Models\PengalihanPengajaranPddikti;

use App\Models\PddiktiPengajaran;
use App\Models\AlihAjarPddikti;
use App\Models\Ppengajaran;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;
use PDF;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB as FacadesDB;

class PddiktiController extends Controller
{

    public function dataAjax(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DosenJson::select("kode_dosen", "nama_dosen")
                ->where('nama_dosen', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function tampilFormTambah()
    {
        return view('pddikti.add_pengajaran_pddikti');
    }

    public function index($id)
    {
        $detail_dosen = FacadesDB::table('pengajaran_pddikti')
            ->join('data_mk', 'data_mk.kode_mk', '=', 'pengajaran_pddikti.matkul_id')
            ->join('data_program_studi', 'data_program_studi.id_prodi', '=', 'pengajaran_pddikti.prodi_id')
            // ->where('akademik_tahun', '=', 'thn_akademik')
            ->where('pengajaran_pddikti.nik', '=', $id)
            ->where('prodi_id', '=', Auth::user()->prodi_id)
            ->whereColumn('akademik_tahun', '=', 'thn_akademik')
            ->get();

        $alih_ajar = FacadesDB::table('alih_ajar_pddikti')
            ->join('data_mk', 'data_mk.kode_mk', '=', 'alih_ajar_pddikti.matkul_id')
            ->join('data_program_studi', 'data_program_studi.id_prodi', '=', 'alih_ajar_pddikti.prodi_id')
            // ->where('akademik_tahun', '=', 'thn_akademik')
            ->where('alih_ajar_pddikti.dosen_alih', '=', $id)
            ->whereColumn('akademik_tahun', '=', 'thn_akademik')
            ->where('prodi_id', '=', Auth::user()->prodi_id)
            ->get();

        $ambil_nik = Ppengajaran::where('nik', '=', $id)->first();

        // mulai itung sks
        $jumSksDosen = [];
        $jumSksDosenAlih = [];
        $jumKelasDosen = [];
        $jumKelasDosenAlih = [];

        foreach ($detail_dosen as $item) {
            $new_array = array($item->matkul_id => $item->sks);
            $jumSksDosen = array_merge($jumSksDosen, $new_array);
            $new_array1 = array($item->matkul_id => $item->jum_kelas);
            $jumKelasDosen = array_merge($jumKelasDosen, $new_array1);
        }

        foreach ($alih_ajar as $data) {

            if (!array_key_exists($data->matkul_id, $jumSksDosenAlih)) {
                $jumSksDosenAlih = array_merge($jumSksDosenAlih, array($data->matkul_id => 0));
            }
            $jumSksDosenAlih[$data->matkul_id] += $data->sks;

            if (!array_key_exists($data->matkul_id, $jumKelasDosenAlih)) {
                $jumKelasDosenAlih = array_merge($jumKelasDosenAlih, array($data->matkul_id => 0));
            }
            $jumKelasDosenAlih[$data->matkul_id] += $data->jum_kelas;
        }

        $finalSksMk = $jumSksDosen;
        $finalKelasMk = $jumKelasDosen;

        foreach ($jumSksDosen as $key => $data) {
            if (array_key_exists($key, $jumSksDosenAlih)) {
                $finalSksMk[$key] -= $jumSksDosenAlih[$key];
            }
        }

        foreach ($jumKelasDosen as $key => $data) {
            if (array_key_exists($key, $jumKelasDosenAlih)) {
                $finalKelasMk[$key] -= $jumKelasDosenAlih[$key];
            }
        }

        //selesai itung sks

        return view('pddikti.detail_dosen_pddikti', [
            'detail_dosen' => $detail_dosen,
            'alih_ajar' => $alih_ajar,
            'jumSksDosen' => $jumSksDosen,
            'jumSksDosenAlih' => $jumSksDosenAlih,
            'finalSksMk' => $finalSksMk,
            'jumKelasDosen' => $jumKelasDosen,
            'jumKelasDosenAlih' => $jumKelasDosenAlih,
            'finalKelasMk' => $finalKelasMk,
            'cnik' => $ambil_nik,
        ]);
    }

    public function edit(Request $request, $id)
    {

        $get_dosen = PddiktiPengajaran::where('id', '=', $id)->first();
        $list_dosen = DosenNidn::get();
        return view('pddikti.update_pengajaran_pddikti', [
            'get_dosen' => $get_dosen,
            'list_dosen' => $list_dosen,
        ]);
    }

    public function store(Request $request, $id)
    {
        $get_nama = DosenNidn::where('no_registrasi', $request->dosen)->first();
        AlihAjarPddikti::create([
            'nik' => $request->dosen,
            'nama_dosen' => $get_nama->nama,
            'matkul_id' => $request->matkul,
            'prodi_id' => $request->prodi,
            'sks' => $request->sks,
            'akademik_tahun' => $request->tahun_ajaran,
            'jum_kelas' => $request->jumkelas,
            'dosen_alih' => $id,
        ]);

        // Alert::success('Sukses', 'Data BKD Berhasil di Tambahkan');
        // return redirect('/pddikti/data');
        return back();
    }

    public function cetakDetailPddikti($id)
    {
        $detail_dosen = FacadesDB::table('pengajaran_pddikti')
            ->join('data_mk', 'data_mk.kode_mk', '=', 'pengajaran_pddikti.matkul_id')
            ->join('data_program_studi', 'data_program_studi.id_prodi', '=', 'pengajaran_pddikti.prodi_id')
            // ->where('akademik_tahun', '=', 'thn_akademik')
            ->where('pengajaran_pddikti.nik', '=', $id)
            ->where('prodi_id', '=', Auth::user()->prodi_id)
            ->whereColumn('akademik_tahun', '=', 'thn_akademik')
            ->get();

        $alih_ajar = FacadesDB::table('alih_ajar_pddikti')
            ->join('data_mk', 'data_mk.kode_mk', '=', 'alih_ajar_pddikti.matkul_id')
            ->join('data_program_studi', 'data_program_studi.id_prodi', '=', 'alih_ajar_pddikti.prodi_id')
            // ->where('akademik_tahun', '=', 'thn_akademik')
            ->where('alih_ajar_pddikti.dosen_alih', '=', $id)
            ->whereColumn('akademik_tahun', '=', 'thn_akademik')
            ->where('prodi_id', '=', Auth::user()->prodi_id)
            ->get();


        // mulai itung sks
        $jumSksDosen = [];
        $jumSksDosenAlih = [];
        $jumKelasDosen = [];
        $jumKelasDosenAlih = [];

        foreach ($detail_dosen as $item) {
            $new_array = array($item->matkul_id => $item->sks);
            $jumSksDosen = array_merge($jumSksDosen, $new_array);
            $new_array1 = array($item->matkul_id => $item->jum_kelas);
            $jumKelasDosen = array_merge($jumKelasDosen, $new_array1);
        }

        foreach ($alih_ajar as $data) {

            if (!array_key_exists($data->matkul_id, $jumSksDosenAlih)) {
                $jumSksDosenAlih = array_merge($jumSksDosenAlih, array($data->matkul_id => 0));
            }
            $jumSksDosenAlih[$data->matkul_id] += $data->sks;

            if (!array_key_exists($data->matkul_id, $jumKelasDosenAlih)) {
                $jumKelasDosenAlih = array_merge($jumKelasDosenAlih, array($data->matkul_id => 0));
            }
            $jumKelasDosenAlih[$data->matkul_id] += $data->jum_kelas;
        }

        $finalSksMk = $jumSksDosen;
        $finalKelasMk = $jumKelasDosen;

        foreach ($jumSksDosen as $key => $data) {
            if (array_key_exists($key, $jumSksDosenAlih)) {
                $finalSksMk[$key] -= $jumSksDosenAlih[$key];
            }
        }

        foreach ($jumKelasDosen as $key => $data) {
            if (array_key_exists($key, $jumKelasDosenAlih)) {
                $finalKelasMk[$key] -= $jumKelasDosenAlih[$key];
            }
        }

        $data = [
            'detail_dosen' => $detail_dosen,
            'alih_ajar' => $alih_ajar,
            'jumSksDosen' => $jumSksDosen,
            'jumSksDosenAlih' => $jumSksDosenAlih,
            'finalSksMk' => $finalSksMk,
            'jumKelasDosen' => $jumKelasDosen,
            'jumKelasDosenAlih' => $jumKelasDosenAlih,
            'finalKelasMk' => $finalKelasMk,
        ];

        $pdf = PDF::loadview('pddikti.laporan_detail_pengajaran', $data)->setPaper('a4', 'landscape');;
        return $pdf->stream();
    }

    public function konfirmasiPengajaran()
    {
        //data table pengalihan_pengajaran_pddikti join table pengajaran_pddikti dan daftar_dosen_nidn
        $konfirmasi_pengajaran = PengalihanPengajaranPddikti::join('pengajaran_pddikti', 'pengajaran_pddikti.id_pengajaran_pddikti', '=', 'pengalihan_pengajaran_pddiktis.id_pengajaran_asal')
            ->join('daftar_dosen_nidn', 'daftar_dosen_nidn.no_registrasi', '=', 'pengalihan_pengajaran_pddiktis.id_dosen_pemberi')
            ->where('pengajaran_pddikti.prodi_id', Auth::user()->prodi_id)
            ->where('pengalihan_pengajaran_pddiktis.status', '=', "menunggu")
            ->get();

        $dosen_anggota = PengalihanPengajaranPddikti::join('pengajaran_pddikti', 'pengajaran_pddikti.id_pengajaran_pddikti', '=', 'pengalihan_pengajaran_pddiktis.id_pengajaran_asal')
            ->join('daftar_dosen_nidn', 'daftar_dosen_nidn.no_registrasi', '=', 'pengalihan_pengajaran_pddiktis.id_dosen_penerima')
            ->where('pengajaran_pddikti.prodi_id', Auth::user()->prodi_id)

            ->get();


        return view('pddikti.konfirmasi_pengajaran', [
            'alih_ajar_pddikti' => $konfirmasi_pengajaran,
            'dosen_anggota' => $dosen_anggota,

        ]);
    }

    public function DetailKonfirmasiPengajaran($id_asal, $id_pemberian)
    {
        $pengalihan_pddikti = PengalihanPengajaranPddikti::join('daftar_dosen_nidn', 'daftar_dosen_nidn.no_registrasi', '=', 'pengalihan_pengajaran_pddiktis.id_dosen_penerima')
            ->where('pengalihan_pengajaran_pddiktis.id_pengajaran_asal', '=', $id_asal)
            ->where('pengalihan_pengajaran_pddiktis.id_pemberian', '=', $id_pemberian)

            ->get();

        return view('pddikti.detail_konfirmasi_pengajaran', [
            'pengalihan' => $pengalihan_pddikti,
        ]);
    }

    public function formPersetujuan($id_asal, $id_pemberian)
    {
        return view('pddikti.form_persetujuan', [
            'id_asal' => $id_asal,
            'id_pemberian' => $id_pemberian,
        ]);
    }

    public function updatePersetujuan(Request $request)
    {
        if (!$request->catatan == null) {
            PengalihanPengajaranPddikti::where('id_pengajaran_asal', $request->id_asal)
                ->where('id_pemberian', $request->id_pemberian)
                ->update([
                    'status' => "disetujui",
                    'catatan_prodi' => $request->catatan
                ]);
        } else {
            PengalihanPengajaranPddikti::where('id_pengajaran_asal', $request->id_asal)
                ->where('id_pemberian', $request->id_pemberian)
                ->update([
                    'status' => "disetujui",
                    'catatan_prodi' => "-"
                ]);
        }
        alert()->success('Sukses', 'Pengajuan Pengajaran Telah Di Setujui');
        return redirect('/konfirmasi/pengajaran');
    }
}
