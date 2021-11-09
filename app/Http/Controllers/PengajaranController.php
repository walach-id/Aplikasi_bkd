<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\User;
use App\Models\Profil;
use App\Models\MataKuliah;
use App\Models\Pengajaran;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use DB;


class PengajaranController extends Controller
{
    public function index()
    {
        if (Auth::user()->jenis == 1) {
            $pengajaran = new Pengajaran();
            $data_pengajaran = Pengajaran::get();
            foreach ($data_pengajaran as $data) {
                if ($data->user_id == Auth::user()->id) {
                    $AmbilData = $pengajaran::join('users', 'users.id', '=', 'pengajarans.wewenang_dosen_id')
                        ->where('user_id', Auth::user()->id)->orWhere('wewenang_dosen_id', Auth::user()->id)
                        ->get(['users.id', 'users.name', 'pengajarans.*']);
                } else {
                    $AmbilData = $pengajaran::join('users', 'users.id', '=', 'pengajarans.user_id')
                        ->where('user_id', Auth::user()->id)->orWhere('wewenang_dosen_id', Auth::user()->id)
                        ->get(['users.id', 'users.name', 'pengajarans.*']);
                }
            }

            if (!$AmbilData->isEmpty()) {
                foreach ($AmbilData as $data) {
                    $matkul = $data->matkul_id;
                    $id_prodi = $data->prodi_id;
                    //$getMatkul = MataKuliah::select('nama_mk')->where('kode_mk', $matkul)->where('thn_akademik', '20211')->where('id_prodi', '13101')->first();
                }

                $getProgramStudi = ProgramStudi::where('id_prodi', $id_prodi)->get();
                return view('pengajaran.dashboard_nidn', [
                    'pengajaran' => $AmbilData,
                    'prodi' => $getProgramStudi,
                ]);
            } else {
                return view('pengajaran.dashboard_empty');
            }
        } else {
            $pengajaran = new Pengajaran();
            $data_pengajaran = Pengajaran::get();
            foreach ($data_pengajaran as $data) {
                if ($data->user_id == Auth::user()->id) {
                    $AmbilData = $pengajaran::join('users', 'users.id', '=', 'pengajarans.wewenang_dosen_id')
                        ->where('user_id', Auth::user()->id)->orWhere('wewenang_dosen_id', Auth::user()->id)
                        ->get(['users.id', 'users.name', 'pengajarans.*']);
                } else {
                    $AmbilData = $pengajaran::join('users', 'users.id', '=', 'pengajarans.user_id')
                        ->where('user_id', Auth::user()->id)->orWhere('wewenang_dosen_id', Auth::user()->id)
                        ->get(['users.id', 'users.name', 'pengajarans.*']);
                }
            }
            if (!$AmbilData->isEmpty()) {
                foreach ($AmbilData as $data) {
                    $matkul = $data->matkul_id;
                    $id_prodi = $data->prodi_id;
                    //$getMatkul = MataKuliah::select('nama_mk')->where('kode_mk', $matkul)->where('thn_akademik', '20211')->where('id_prodi', '13101')->first();
                }
                $getProgramStudi = ProgramStudi::where('id_prodi', $id_prodi)->get();
                return view('pengajaran.dashboard', [
                    'pengajaran' => $AmbilData,
                    'prodi' => $getProgramStudi,
                ]);
            } else {
                return view('pengajaran.dashboard_empty');
            }
        }
    }



    public function formAddPengajaran()
    {
        $matkul = new MataKuliah();
        $dosen = new User();
        $getProgramStudi = Profil::where('user_profile', Auth::user()->id)->get();
        foreach ($getProgramStudi as $data) {
            $prodi = $data->program_studi_id;
        }
        //Ambil seluruh data matkul
        $listMatkul = $matkul::select('*')->where('thn_akademik', '>=', now()->year . '1')
            ->where('id_prodi', '=', $prodi)
            ->OrderBy('nama_mk', 'ASC')->get();
        $listDosen = $dosen::select("*")->where('jenis', '=', 1)
            ->where('id', 'not like', Auth::user()->id)
            ->OrderBy('name', 'ASC')->get();


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
            $pengajaran->id = null;
            $pengajaran->user_id = Auth::user()->id;
            $pengajaran->matkul = $request->matkul;
            $pengajaran->matkul_id = $kodemk;

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

        $pdf = PDF::loadview('pengajaran.laporan_pengajaran', $data)->setPaper('a4', 'potrait');;
        return $pdf->stream();
    }
}
