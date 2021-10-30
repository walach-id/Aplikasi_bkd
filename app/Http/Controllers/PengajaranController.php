<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajaran;

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
}
