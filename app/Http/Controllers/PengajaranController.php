<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajaran;
use App\Models\MataKuliah;
use App\Models\User;

class PengajaranController extends Controller
{
    public function index()
    {
        $pengajaran = new Pengajaran();
        $AmbilData = $pengajaran::where('user_id', Auth::user()->id)->get();

        return view('pengajaran.dashboard', [
            'pengajaran' => $pengajaran,
        ]);
    }

    public function formAddPengajaran()
    {
        $matkul = new MataKuliah();
        $dosen = new User();
        //Ambil seluruh data matkul
        $listMatkul = $matkul::select('*')->where('thn_akademik', '>=', now()->year . '1')->where('id_prodi', '=', 13211)->OrderBy('nama_mk', 'ASC')->get();
        $listDosen = $dosen::select("*")->where('jenis', '=', 1)->OrderBy('name', 'ASC')->get();


        return view('pengajaran.add_pengajaran', [
            'matkul' => $listMatkul,
            'dosen' => $listDosen,
        ]);
    }
}
