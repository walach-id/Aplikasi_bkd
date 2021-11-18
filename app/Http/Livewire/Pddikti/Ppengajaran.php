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

    public $matkul, $prodi, $sks, $jumkelas, $tahun_ajaran, $sms, $rasio;
    public $no_induk, $bio_dosen1, $no_induk1, $bio_dosen, $listDosen, $listDosen1;
    public $namaDosen, $idDosen, $namaDosen1, $idDosen1;

    protected $rules = [
        'listDosen.*.no_registrasi' => '',
        'listDosen.*.nama' => '',

        'listDosen1.*.no_registrasi' => '',
        'listDosen1.*.nama' => '',
    ];


    public function mount()
    {
        $this->getDosen();
        $this->getDosen1();
    }

    public function updatedNamaDosen()
    {
        $this->getDosen();
    }

    public function updatedNamaDosen1()
    {
        $this->getDosen1();
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

    public function getDosen1()
    {
        if (!empty($this->namaDosen1) || $this->namaDosen1 !== null) {
            $this->listDosen1 = DosenNidn::query()
                ->when($this->namaDosen1, function ($query, $name) {
                    return $query->where('nama', 'LIKE', '%' . $name . '%');
                })
                ->orderBy('nama')
                ->limit(10)
                ->get();
        } else {
            $this->listDosen1 = [];
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

        // dosen utama
        $biodata_dosen = DosenNidn::where('no_registrasi', '=', $this->idDosen)
            ->first();

        if ($biodata_dosen == null || $biodata_dosen == "") {
            $this->bio_dosen = "-";
            $this->no_induk = "-";
        } else {
            $this->bio_dosen = $biodata_dosen->jabfung;
            $this->no_induk = $biodata_dosen->no_registrasi;
        }

        // dosen yang dialihkan
        $biodata_dosen1 = DosenNidn::where('no_registrasi', '=', $this->idDosen1)
            ->first();

        if ($biodata_dosen1 == null || $biodata_dosen1 == "") {
            $this->bio_dosen1 = "-";
            $this->no_induk1 = "-";
        } else {
            $this->bio_dosen1 = $biodata_dosen1->jabfung;
            $this->no_induk1 = $biodata_dosen1->no_registrasi;
        }


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
