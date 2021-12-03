<?php

namespace App\Http\Livewire\Pddikti;

use Livewire\Component;
use App\Models\MataKuliah;
use App\Models\Krs;
use App\Models\DosenNidn;
use App\Models\PddiktiPengajaran;
use App\Models\ProgramStudi;
use App\Models\AlihAjarPddikti;

class ViewDosen extends Component
{
    public function render()
    {
        $AmbilData = PddiktiPengajaran::groupBy('nik')
            ->groupBy('nama_dosen')
            ->selectRaw('sum(sks) as sum, nik, nama_dosen')
            ->get();

        $Alih_ajar = AlihAjarPddikti::groupBy('nik')
            ->groupBy('nama_dosen')
            ->selectRaw('sum(sks) as sum, nik, nama_dosen')
            ->get();
        return view('livewire.pddikti.view-dosen', [
            'data_dosen' => $AmbilData,
            'alih_ajar' => $Alih_ajar,
        ]);
    }
}