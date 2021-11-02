<?php

namespace App\Models;

use App\Models\Profil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajaran extends Model
{
    use HasFactory;

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function matakuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'user_id');
    }
}
