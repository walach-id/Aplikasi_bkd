<?php

namespace App\Http\Livewire\Pddikti;

use Livewire\Component;
use App\Models\User;
use App\Models\Profil;
use App\Models\MataKuliah;
use App\Models\Krs;
use App\Models\DosenNidn;
use App\Models\Pddiktipengajaran;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;
use App\Imports\PengajaranImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class Ppengajaran extends Component
{

    public $dosen, $matkul, $prodi, $sks, $jumkelas, $tahun_ajaran, $sms, $rasio, $listDosen;
    public $namaDosen, $idDosen;

    protected $rules = [
        'listDosen.*.no_registrasi' => '',
        'listDosen.*.nama' => '',

        'dosen.no_registrasi' => '',
        'dosen.nama' => '',
    ];


    public function mount()
    {
        $this->getDosen();
    }

    public function updatedIdDosen()
    {
        $this->dosen = DosenNidn::where('no_registrasi', '=', $this->idDosen)->first();
    }

    public function updatedNamaDosen()
    {
        $this->getDosen();
    }

    public function getDosen()
    {
        if (!empty($this->namaDosen) || $this->namaDosen !== null) {
            $this->listDosen = DosenNidn::query()
                ->when($this->namaDosen, function ($query, $name) {
                    return $query->where('nama', 'LIKE', '%' . $name . '%');
                })
                ->orderBy('nama')
                ->limit(10)
                ->get();
        } else {
            $this->listDosen = [];
        }
    }

    public function render()
    {

        $data_prodi = ProgramStudi::get();


        //Ambil seluruh data matkul
        $tahun_akademik = $this->tahun_ajaran . $this->sms;
        $listMatkul = MataKuliah::where('id_prodi', '=', $this->prodi)
            ->where('thn_akademik', '=', $tahun_akademik)
            ->OrderBy('nama_mk', 'ASC')->get();

        $banyak_mahasiswa = krs::where('id_prodi', '=', $this->prodi)
            ->where('kode_mk', '=', $this->matkul)
            ->where('thn_akademik', '=', $tahun_akademik)
            ->count();

        $select_sks = MataKuliah::where('id_prodi', '=', $this->prodi)
            ->where('thn_akademik', '=', $tahun_akademik)
            ->where('kode_mk', '=', $this->matkul)
            ->first();

        if ($this->matkul == "" || $this->prodi == "" || ($this->tahun_ajaran == "" && $this->sms == "")) {
            $this->sks = "";
        } else {
            $this->sks = $select_sks->jml_sks;
        }

        if ($this->rasio == 0) {
            $this->jumkelas = 0;
        } else {
            $this->jumkelas = ceil($banyak_mahasiswa / $this->rasio);
        }

        return view('livewire.pddikti.ppengajaran', [
            'data_matkul' => $listMatkul,
            'data_prodi' => $data_prodi,
            'mahasiswa' => $banyak_mahasiswa,
        ]);
    }


    public function change()
    {

        $this->tahun_ajaran = "";
        $this->sms = "";
        $this->matkul = "";
    }

    public function selectProdi($data)
    {
        $this->prodi = $data;
    }

    public function clearForm()
    {
        $this->dosen = "";
        $this->prodi = "";
        $this->semester = "";
        $this->tahun_ajaran = "";
        $this->sms = "";
        $this->matkul = "";
        $this->sks = "";
        $this->jumkelas = "";
    }

    public function storePpengajaran()
    {
        $panggil_nama = User::where('nik', $this->dosen)
            ->first();
        // dd($panggil_nama->name);
        dd($this->matkul);
        $pengajaran = new Ppengajaran();
        $pengajaran->id = null;
        $pengajaran->nik = $this->dosen;
        $pengajaran->nama_dosen = $panggil_nama->name;
        $pengajaran->matkul_id = $this->matkul;
        $pengajaran->prodi_id = $this->prodi;
        $pengajaran->sks = $this->sks;
        $pengajaran->semester = $this->semester;
        $pengajaran->jum_kelas = $this->jumkelas;

        $pengajaran->save();

        // Alert::success('Sukses', 'Data BKD Berhasil di Tambahkan');
        // return redirect('/pddikti/data');
        return back();
    }
}
