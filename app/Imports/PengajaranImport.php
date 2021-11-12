<?php

namespace App\Imports;

use App\Models\Ppengajaran;
use Maatwebsite\Excel\Concerns\ToModel;

class PengajaranImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Ppengajaran([
            'nik' => $row[0],
            'prodi_id' => $row[1],
            'matkul_id' => $row[2],
            'sks' => $row[3],
            'semester' => $row[4],
            'jum_kelas' => $row[5],
            'nama_dosen' => $row[6],
        ]);
    }
}
