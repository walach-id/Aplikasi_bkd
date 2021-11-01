<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajaran;
use App\Models\MataKuliah;
use App\Models\ProgramStudi;
use App\Models\User;
use Alert;


class PengajaranController extends Controller
{
    public function index()
    {

        $pengajaran = new Pengajaran();
        $AmbilData = $pengajaran::where('user_id', Auth::user()->id)->get();
        foreach ($AmbilData as $data) {
            $matkul = $data->matkul_id;
            $id_prodi = $data->prodi_id;
        }
        $getMatkul = MataKuliah::select('nama_mk')->where('kode_mk', $matkul)->get();
        $getProgramStudi = ProgramStudi::select('program_studi')->where('id_prodi', $id_prodi)->get();
        return view('pengajaran.dashboard', [
            'pengajaran' => $AmbilData,
            'matkul' => $getMatkul,
            'prodi' => $getProgramStudi,
        ]);
    }

    public function formAddPengajaran()
    {
        $matkul = new MataKuliah();
        $dosen = new User();
        //Ambil seluruh data matkul
        $listMatkul = $matkul::select('*')->where('thn_akademik', '>=', now()->year . '1')->where('id_prodi', '=', 13211)->OrderBy('nama_mk', 'ASC')->get();
        $listDosen = $dosen::select("*")->where('jenis', '=', 1)->OrderBy('name', 'ASC')->get();


        return view('pengajaran.add_pengajaran', [
            'matkul' => $listMatkul,
            'dosen' => $listDosen,
        ]);
    }

    public function storePengajaran(Request $request)
    {
        if ($request->jumtugas >= $request->jumpertemuan) {
            Alert::warning('Peringatan', 'Jumlah tugas diberikan harus kurang dari jumlah pertemuan');
            return redirect()->back();
        } else {
            $pengajaran = new Pengajaran();
            $pengajaran->id = null;
            $pengajaran->user_id = Auth::user()->id;
            $pengajaran->matkul_id = $request->matkul;
            $pengajaran->prodi_id = '130101';
            $pengajaran->jenis_kegiatan = $request->matkul;
            $pengajaran->bukti_penugasan = $request->buktipenugasan;
            $pengajaran->sks = $request->jumsks;
            $pengajaran->masa_penugasan = $request->masapenugasan;
            $pengajaran->bukti_dokumen = $request->buktidokumen;
            $pengajaran->jumlah_pertemuan = $request->jumpertemuan;
            $pengajaran->wewenang_dosen_id = $request->dosen;
            $pengajaran->jumlah_wewenang = $request->jumtugas;

            $pengajaran->save();

            Alert::success('Sukses', 'Data BKD Berhasil di Tambahkan');
            return redirect('/bkd');
        }
    }

    public function detailBKD($id)
    {
        dd($id);
    }
}
