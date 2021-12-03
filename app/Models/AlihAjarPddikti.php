<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlihAjarPddikti extends Model
{
    use HasFactory;
    protected $table = 'alih_ajar_pddikti';
    protected $fillable = [
        'nik',
        'nama_dosen',
        'prodi_id',
        'matkul_id',
        'sks',
        'akademik_tahun',
        'semester',
        'jum_kelas',
        'dosen_alih'
    ];
}
