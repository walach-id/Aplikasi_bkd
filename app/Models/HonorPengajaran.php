<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HonorPengajaran extends Model
{
    use HasFactory;
    protected $table = "pengajaran_honors";
    protected $fillable = [
        'id_pengajaran_honor',
        'prodi_id',
        'nama_matkul',
        'sks_pengajaran',
        'sks_asli',
        'akademik_tahun',
        'jum_kelas',
        'jum_mengajar',
        'tipe_mengajar'
    ];
}