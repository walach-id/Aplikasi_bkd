<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\User;
use App\Models\Profil;
use App\Models\MataKuliah;
use App\Models\Krs;
use App\Models\DosenNidn;
use App\Models\PddiktiPengajaran;
use App\Models\AlihAjarPddikti;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;
use PDF;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB as FacadesDB;

class PddiktiController extends Controller
{
    public function index($id)
    {
        $detail_dosen = FacadesDB::table('pengajaran_pddikti')
            ->join('data_mk', 'data_mk.kode_mk', '=', 'pengajaran_pddikti.matkul_id')
            ->join('data_program_studi', 'data_program_studi.id_prodi', '=', 'pengajaran_pddikti.prodi_id')
            // ->where('akademik_tahun', '=', 'thn_akademik')
            ->where('pengajaran_pddikti.nik', '=', $id)
            ->whereColumn('akademik_tahun', '=', 'thn_akademik')
            ->get();

        $alih_ajar = FacadesDB::table('alih_ajar_pddikti')
            ->join('data_mk', 'data_mk.kode_mk', '=', 'alih_ajar_pddikti.matkul_id')
            ->join('data_program_studi', 'data_program_studi.id_prodi', '=', 'alih_ajar_pddikti.prodi_id')
            // ->where('akademik_tahun', '=', 'thn_akademik')
            ->where('alih_ajar_pddikti.dosen_alih', '=', $id)
            ->whereColumn('akademik_tahun', '=', 'thn_akademik')
            ->get();

        foreach ($detail_dosen as $item) {
            $sks_pengajaran = $item->sks;
        }

        foreach ($alih_ajar as $data) {
            $sks_alih = $data->sks;
        }

        // dd([
        //     "sks_pengajaran" => $sks_pengajaran,
        //     "sks_alih" => $sks_alih,
        //     "sisa" => $sks_pengajaran - $sks_alih
        // ]);




        return view('pddikti.detail_dosen_pddikti', [
            'detail_dosen' => $detail_dosen,
            'alih_ajar' => $alih_ajar,
        ]);
    }

    public function edit(Request $request, $id)
    {

        $get_dosen = PddiktiPengajaran::where('id', '=', $id)->first();
        $list_dosen = DosenNidn::get();
        return view('pddikti.update_pengajaran_pddikti', [
            'get_dosen' => $get_dosen,
            'list_dosen' => $list_dosen,
        ]);
    }

    public function store(Request $request, $id)
    {
        $get_nama = DosenNidn::where('no_registrasi', $request->dosen)->first();
        AlihAjarPddikti::create([
            'nik' => $request->dosen,
            'nama_dosen' => $get_nama->nama,
            'matkul_id' => $request->matkul,
            'prodi_id' => $request->prodi,
            'sks' => $request->sks,
            'akademik_tahun' => $request->tahun_ajaran,
            'jum_kelas' => $request->jumkelas,
            'dosen_alih' => $id,
        ]);

        // Alert::success('Sukses', 'Data BKD Berhasil di Tambahkan');
        // return redirect('/pddikti/data');
        return back();
    }
}
