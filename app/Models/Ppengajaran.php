<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppengajaran extends Model
{
    use HasFactory;
    protected $table = 'pengajaran_pddikti';
    protected $fillable = [
        'nik',
        'nama_dosen',
        'prodi_id',
        'matkul_id',
        'sks',
        'semester',
        'jum_kelas',
    ];
}
