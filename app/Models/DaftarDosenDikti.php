<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarDosenDikti extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pengajaran_pddikti',
        'dosen',
        'dosen_anggota'
    ];
}
