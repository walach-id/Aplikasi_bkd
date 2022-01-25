<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarDosenHonor extends Model
{
    use HasFactory;

    protected $table = "daftar_dosen_honors";

    protected $fillable = [
        'id_pengajaran_honor',
        'dosen',
        'dosen_anggota'
    ];
}
