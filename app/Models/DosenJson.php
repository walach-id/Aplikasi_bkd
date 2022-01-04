<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenJson extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'kode_dosen';
    protected $table = 'data_dosen';
}
