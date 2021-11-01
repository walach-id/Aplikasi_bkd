<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
