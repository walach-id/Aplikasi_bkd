<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profil;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\MataKuliah;
use App\Models\Pengajaran;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class PengajaranController extends Controller
{
    public function index()
    {
        $userNidn = Auth::user()->jenis == 1 ? true : false;

        $pengajar = Pengajaran::first()->user_id == Auth::user()->id ? 'pengajarans.wewenang_dosen_id' : 'pengajarans.user_id';

        $AmbilData = Pengajaran::join('users', 'users.id', '=', $pengajar)
            ->where('user_id', Auth::user()->id)->orWhere('wewenang_dosen_id', Auth::user()->id)
            ->get(['users.id', 'users.name', 'pengajarans.*']);


        if ($AmbilData->isEmpty()) {
            return view('pengajaran.dashboard_empty');
        }

        foreach ($AmbilData as $data) {
            $matkul = $data->matkul_id;
            $id_prodi = $data->prodi_id;
        }

        $getProgramStudi = ProgramStudi::where('id_prodi', $id_prodi)->get();

        $viewFile = $userNidn ? 'pengajaran.dashboard_nidn' : 'pengajaran.dashboard';

        return view($viewFile, [
            'pengajaran' => $AmbilData,
            'prodi' => $getProgramStudi,
        ]);
    }

    public function formAddPengajaran()
    {

        // ddd(Auth::user());
        $prodi = Profil::where('user_profile', Auth::user()->id)->first()->program_studi_id;

        //Ambil seluruh data matkul
        $listMatkul = MataKuliah::where('thn_akademik', '>=', now()->year . '1')
            ->where('id_prodi', '=', $prodi)
            ->OrderBy('nama_mk', 'ASC')->get();

        $listDosen = User::where('jenis', '=', 1)
            ->OrderBy('name', 'ASC')->get()
            ->except(Auth::user()->id);


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
            $getProgramStudi = Profil::where('user_profile', Auth::user()->id)->get();
            foreach ($getProgramStudi as $data) {
                $prodi = $data->program_studi_id;
            }

            $getNamaProdi = ProgramStudi::where('id_prodi', $prodi)->get();
            foreach ($getNamaProdi as $data) {
                $namaprodi = $data->program_studi;
            }

            $getKodeMatkul = MataKuliah::where('nama_mk', $request->matkul)->where('id_prodi', $prodi)->get();
            foreach ($getKodeMatkul as $data) {
                $kodemk = $data->kode_mk;
            }

            $pengajaran = new Pengajaran();
            $pengajaran->matkul = $request->matkul;

            $pengajaran->prodi_id = $prodi;
            $pengajaran->prodi = $namaprodi;

            $pengajaran->jenis_kegiatan = $request->matkul;
            // $pengajaran->bukti_penugasan = $request->buktipenugasan;
            $pengajaran->sks = $request->jumsks;
            $pengajaran->masa_penugasan = $request->masapenugasan;
            // $pengajaran->bukti_dokumen = $request->buktidokumen;
            $pengajaran->jumlah_pertemuan = $request->jumpertemuan;
            $pengajaran->wewenang_dosen_id = $request->dosen;
            $pengajaran->jumlah_wewenang = $request->jumtugas;

            Pengajaran::create(array_merge($request), [
                'matkul_id' => MataKuliah::where('nama_mk', $request->matkul)->where('id_prodi', $prodi)->first(),
                'user_id' => Auth::user()->id,
                'prodi' => ProgramStudi::where('id_prodi', $prodi)->first(),

            ]);


            $pengajaran->save();

            Alert::success('Sukses', 'Data BKD Berhasil di Tambahkan');
            return redirect('/bkd');
        }
    }

    public function detailBKD($id)
    {
        $pengajaran = Pengajaran::where('id', $id)->first();
        $get_profil = Pengajaran::where('id', $id)->first();

        if ($get_profil->user_id == Auth::user()->id) {
            $pengajaran = Pengajaran::join('data_mk', 'data_mk.kode_mk', '=', 'pengajarans.matkul_id')
                ->join('data_program_studi', 'data_program_studi.id_prodi', '=', 'pengajarans.prodi_id')
                ->join('users', 'users.id', '=', 'pengajarans.wewenang_dosen_id')
                ->where('pengajarans.id', $id)
                ->first(['data_mk.kode_mk', 'data_mk.nama_mk', 'data_program_studi.id_prodi', 'data_program_studi.program_studi', 'users.id', 'users.name', 'pengajarans.*']);
        } else {
            $pengajaran = Pengajaran::join('data_mk', 'data_mk.kode_mk', '=', 'pengajarans.matkul_id')
                ->join('data_program_studi', 'data_program_studi.id_prodi', '=', 'pengajarans.prodi_id')
                ->join('users', 'users.id', '=', 'pengajarans.user_id')
                ->where('pengajarans.id', $id)
                ->first(['data_mk.kode_mk', 'data_mk.nama_mk', 'data_program_studi.id_prodi', 'data_program_studi.program_studi', 'users.id', 'users.name', 'pengajarans.*']);
        }

        return view('pengajaran.detail_pengajaran', [
            'pengajaran' => $pengajaran,
        ]);
    }

    public function cetakPDF()
    {
        $AmbilData = Pengajaran::groupBy('matkul')
            ->groupBy('prodi')
            ->selectRaw('sum(jumlah_wewenang) as sum, matkul, prodi')
            ->where('user_id', Auth::user()->id)
            ->get();

        $AmbilData1 = Pengajaran::groupBy('user_id')
            ->groupBy('matkul')
            ->selectRaw('user_id, matkul, jumlah_wewenang')
            ->where('user_id', Auth::user()->id)
            ->sum('jumlah_wewenang');



        // $users = Pengajaran::groupBy('user_id')
        //     ->groupBy('matkul')
        //     ->get();

        $data = [
            // 'total' => $AmbilData1,
            'pengajaran' => $AmbilData,
            'dosen' => Profil::where('user_profile', '=', Auth::user()->id)->first(),
        ];

        return PDF::loadview('pengajaran.laporan_pengajaran', $data)->setPaper('a4', 'potrait')->stream();
    }
}
