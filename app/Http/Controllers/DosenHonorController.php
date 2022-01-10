<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HonorPengajaran;
use App\Models\DaftarDosenHonor;
use Illuminate\Support\Facades\Auth;

class DosenHonorController extends Controller
{
    public function index()
    {
        $AmbilData = HonorPengajaran::join('daftar_dosen_honors', 'daftar_dosen_honors.id_pengajaran_honor', '=', 'pengajaran_honors.id_pengajaran_honor')
            ->join('data_dosen', 'data_dosen.kode_dosen', '=', 'daftar_dosen_honors.dosen')
            ->groupBy('pengajaran_honors.id_pengajaran_honor')
            ->groupBy('pengajaran_honors.nama_matkul')
            ->groupBy('pengajaran_honors.sks_asli')
            ->groupBy('pengajaran_honors.akademik_tahun')
            ->groupBy('data_dosen.nama_dosen')
            ->selectRaw('pengajaran_honors.id_pengajaran_honor, pengajaran_honors.nama_matkul, pengajaran_honors.sks_asli, pengajaran_honors.akademik_tahun, data_dosen.nama_dosen')
            ->where('pengajaran_honors.prodi_id', Auth::user()->prodi_id)
            ->get();

        // dd($AmbilData);

        // $data_dikti = Ppengajaran::join('daftar_dosen_diktis', 'daftar_dosen_diktis.id_pengajaran_pddikti', '=', 'pengajaran_pddikti.id_pengajaran_pddikti')
        //     ->join('data_dosen', 'data_dosen.kode_dosen', '=', 'daftar_dosen_diktis.dosen')
        //     ->groupBy('pengajaran_pddikti.id_pengajaran_pddikti')
        //     ->groupBy('data_dosen.nama_dosen')
        //     ->selectRaw('pengajaran_pddikti.id_pengajaran_pddikti, data_dosen.nama_dosen, sum(sks) as jum')
        //     ->get();

        // $Alih_ajar = AlihAjarPddikti::groupBy('nik')
        //     ->groupBy('nama_dosen')
        //     ->selectRaw('sum(sks_asli) as sum, nik, nama_dosen')
        //     ->get();
        return view('pddikti.data_dosen_honor', [
            'data_dosen' => $AmbilData,
            // 'alih_ajar' => $Alih_ajar,
        ]);
    }

    public function detail($id)
    {
        $detail_data = HonorPengajaran::join('daftar_dosen_honors', 'daftar_dosen_honors.id_pengajaran_honor', '=', 'pengajaran_honors.id_pengajaran_honor')
            ->join('data_dosen', 'data_dosen.kode_dosen', '=', 'daftar_dosen_honors.dosen')
            ->where('pengajaran_honors.prodi_id', Auth::user()->prodi_id)
            ->where('pengajaran_honors.id_pengajaran_honor', $id)
            ->first();

        $anggota = DaftarDosenHonor::join('data_dosen', 'data_dosen.kode_dosen', '=', 'daftar_dosen_honors.dosen_anggota')
            ->where('id_pengajaran_honor', $id)
            ->get();

        return view('pddikti.detail_dosen_honor', [
            'detail_dosen' => $detail_data,
            'anggota' => $anggota
            // 'alih_ajar' => $Alih_ajar,
        ]);
    }
}
