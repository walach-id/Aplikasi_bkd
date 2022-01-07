<?php

namespace App\Http\Livewire\Pddikti;

use Livewire\Component;
use App\Models\Ppengajaran;
use App\Models\HonorPengajaran;


class ViewDosen extends Component
{
    public function render()
    {
        $AmbilData = HonorPengajaran::join('daftar_dosen_honors', 'daftar_dosen_honors.id_pengajaran_honor', '=', 'pengajaran_honors.id_pengajaran_honor')
            ->join('data_dosen', 'data_dosen.kode_dosen', '=', 'daftar_dosen_honors.dosen')
            ->groupBy('pengajaran_honors.id_pengajaran_honor')
            ->groupBy('pengajaran_honors.nama_matkul')
            ->groupBy('pengajaran_honors.sks_asli')
            ->groupBy('pengajaran_honors.akademik_tahun')
            ->groupBy('data_dosen.nama_dosen')
            ->selectRaw('pengajaran_honors.id_pengajaran_honor, pengajaran_honors.nama_matkul, pengajaran_honors.sks_asli, pengajaran_honors.akademik_tahun, data_dosen.nama_dosen')
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
        return view('livewire.pddikti.view-dosen', [
            'data_dosen' => $AmbilData,
            // 'alih_ajar' => $Alih_ajar,
        ]);
    }
}
