<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profil;
use App\Models\MataKuliah;
use App\Models\Ppengajaran;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;
use App\Imports\PengajaranImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class PpengajaranController extends Controller
{
    public function formAddPpengajaran(Request $request)
    {
        $matkul = new MataKuliah();
        $dosen = new User();
        $data_prodi = ProgramStudi::get();
        $getProgramStudi = Profil::where('user_profile', Auth::user()->id)->get();
        foreach ($getProgramStudi as $data) {
            $prodi = $data->program_studi_id;
        }
        //Ambil seluruh data matkul
        $listMatkul = $matkul::select('*')
            ->where('thn_akademik', '>=', now()->year . '1')
            ->where('id_prodi', '=', $prodi)
            ->OrderBy('nama_mk', 'ASC')->get();

        $listDosen = $dosen::select("*")->where('jenis', '=', 1)
            ->where('id', 'not like', Auth::user()->id)
            ->OrderBy('name', 'ASC')->get();


        return view('pddikti.add_pengajaran_pddikti', [
            'matkul' => $listMatkul,
            'dosen' => $listDosen,
            'prodi' => $data_prodi,
        ]);
    }

    public function storePpengajaran(Request $request)
    {
        $panggil_nama = User::where('nik', $request->dosen)
            ->first();

        // dd($panggil_nama->name);
        $pengajaran = new Ppengajaran();
        $pengajaran->id = null;
        $pengajaran->nik = $request->dosen;
        $pengajaran->nama_dosen = $panggil_nama->name;
        $pengajaran->matkul_id = $request->matkul;
        $pengajaran->prodi_id = $request->prodi;
        $pengajaran->sks = $request->sks;
        $pengajaran->semester = $request->semester;
        $pengajaran->jum_kelas = $request->jumkelas;

        $pengajaran->save();

        // Alert::success('Sukses', 'Data BKD Berhasil di Tambahkan');
        return redirect('/pddikti/data');
    }

    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_siswa', $nama_file);

        // import data
        Excel::import(new PengajaranImport, public_path('/file_siswa/' . $nama_file));

        // notifikasi dengan session
        // Session::flash('sukses', 'Data Siswa Berhasil Diimport!');

        // alihkan halaman kembali
        return back();
    }

    public function index()
    {
        $pengajaran = Ppengajaran::join('data_mk', 'data_mk.kode_mk', '=', 'pengajaran_pddikti.matkul_id')

            ->join('data_program_studi', 'data_program_studi.id_prodi', '=', 'pengajaran_pddikti.prodi_id')
            ->where('thn_akademik', '=', '20211')
            ->get(['data_program_studi.program_studi', 'data_mk.nama_mk', 'pengajaran_pddikti.*']);

        return view('pddikti.data_pengajaran_pddikti', [
            'pengajaran' => $pengajaran,
        ]);
    }

    public function tampil_pengajaran()
    {
        $pengajaran = Ppengajaran::join('data_mk', 'data_mk.kode_mk', '=', 'pengajaran_pddikti.matkul_id')
            ->join('data_program_studi', 'data_program_studi.id_prodi', '=', 'pengajaran_pddikti.prodi_id')
            ->where('thn_akademik', '=', '20211')
            ->where('nik', Auth::user()->nik)
            ->get(['data_program_studi.program_studi', 'data_mk.nama_mk', 'pengajaran_pddikti.*']);

        return view('pddikti.dosen_pengajaran_pddikti', [
            'pengajaran' => $pengajaran,
        ]);
    }
}
