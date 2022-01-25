<?php

namespace App\Http\Controllers;

use App\Models\PddiktiPengajaran;
use App\Models\DaftarDosenDikti;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DosenPddiktiController extends Controller
{
    public function index()
    {
        $AmbilData = PddiktiPengajaran::join('daftar_dosen_diktis', 'daftar_dosen_diktis.id_pengajaran_pddikti', '=', 'pengajaran_pddikti.id_pengajaran_pddikti')
            ->join('daftar_dosen_nidn', 'daftar_dosen_nidn.no_registrasi', '=', 'daftar_dosen_diktis.dosen')
            ->groupBy('pengajaran_pddikti.id_pengajaran_pddikti')
            ->groupBy('pengajaran_pddikti.nama_matkul')
            ->groupBy('pengajaran_pddikti.sks_asli')
            ->groupBy('pengajaran_pddikti.akademik_tahun')
            ->groupBy('daftar_dosen_nidn.nama')
            ->selectRaw('pengajaran_pddikti.id_pengajaran_pddikti, pengajaran_pddikti.nama_matkul, pengajaran_pddikti.sks_asli, pengajaran_pddikti.akademik_tahun, daftar_dosen_nidn.nama')
            ->where('pengajaran_pddikti.prodi_id', Auth::user()->prodi_id)
            ->get();

        return view('pddikti.data_dosen_pddikti', [
            'data_dosen' => $AmbilData,
            // 'alih_ajar' => $Alih_ajar,
        ]);
    }

    public function detail($id)
    {
        $detail_data = PddiktiPengajaran::join('daftar_dosen_diktis', 'daftar_dosen_diktis.id_pengajaran_pddikti', '=', 'pengajaran_pddikti.id_pengajaran_pddikti')
            ->join('daftar_dosen_nidn', 'daftar_dosen_nidn.no_registrasi', '=', 'daftar_dosen_diktis.dosen')
            ->where('pengajaran_pddikti.prodi_id', Auth::user()->prodi_id)
            ->where('pengajaran_pddikti.id_pengajaran_pddikti', $id)
            ->first();

        $anggota = DaftarDosenDikti::join('daftar_dosen_nidn', 'daftar_dosen_nidn.no_registrasi', '=', 'daftar_dosen_diktis.dosen_anggota')
            ->where('id_pengajaran_pddikti', $id)
            ->get();

        return view('pddikti.detail_dosen_pddikti', [
            'detail_dosen' => $detail_data,
            'anggota' => $anggota
            // 'alih_ajar' => $Alih_ajar,
        ]);
    }
}
