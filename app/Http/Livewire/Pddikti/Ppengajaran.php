<?php

namespace App\Http\Livewire\Pddikti;

use Livewire\Component;
use App\Models\User;
use App\Models\Profil;
use App\Models\MataKuliah;
use App\Models\Krs;
use App\Models\DosenNidn;
use App\Models\DosenJson;
use App\Models\PddiktiPengajaran;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;
use App\Imports\PengajaranImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class Ppengajaran extends Component
{

    public $matkul, $prodi, $sks, $jumkelas, $jumkelasp, $tahun_ajaran, $sms, $rasio;
    public $no_induk, $bio_dosen, $listDosen = [];
    public $namaDosen, $idDosen, $matkul_jenis;

    protected $rules = [
        'listDosen.*.nama_dosen' => '',
        'listDosen.*.kode_dosen' => '',
    ];


    public function mount()
    {
        $this->getDosen();
    }

    public function updatedNamaDosen()
    {
        $this->getDosen();
    }


    public function getDosen()
    {
        if (!empty($this->namaDosen) || $this->namaDosen !== null) {
            $this->listDosen = DosenJson::query()
                ->when($this->namaDosen, function ($query, $name) {
                    return $query->where('nama_dosen', 'LIKE', '%' . $name . '%');
                })
                ->orderBy('nama_dosen')
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
        $listMatkul = MataKuliah::where('id_prodi', '=', Auth::user()->prodi_id)
            ->where('thn_akademik', '=', $tahun_akademik)
            ->OrderBy('nama_mk', 'ASC')->get();

        //$this->sks_penyesuaian = $this->sks * $this->jumkelasp;
        if ($this->sks == null || $this->jumkelasp == null) {
            $this->sks_penyesuaian = 0;
        } else {
            $this->sks_penyesuaian = $this->sks * $this->jumkelasp;
        }

        $banyak_mahasiswa = krs::where('id_prodi', '=', Auth::user()->prodi_id)
            ->where('kode_mk', '=', $this->matkul)
            ->where('thn_akademik', '=', $tahun_akademik)
            ->count();

        $select_sks = MataKuliah::where('id_prodi', '=', Auth::user()->prodi_id)
            ->where('thn_akademik', '=', $tahun_akademik)
            ->where('kode_mk', '=', $this->matkul)
            ->first();

        // dosen utama
        // $biodata_dosen = DosenJson::where('kode_dosen', '=', $this->idDosen)
        //     ->first();

        // if ($biodata_dosen == null || $biodata_dosen == "") {
        //     $this->bio_dosen = "-";
        //     $this->no_induk = "-";
        // } else {
        //     $this->bio_dosen = $biodata_dosen->jabfung;
        //     $this->no_induk = $biodata_dosen->no_registrasi;
        // }

        // dosen yang dialihkan


        if ($this->matkul == "" || ($this->tahun_ajaran == "" && $this->sms == "")) {
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
        $this->jumkelasp = "";
    }

    public function storePpengajaran()
    {
        if (($this->sks * $this->jumkelas) >= 16) {
            Alert::warning('Peringatan', 'Jumlah tugas diberikan melebihi batas');
            return back();
        } else {


            PddiktiPengajaran::create([
                'nik' => $this->idDosen,
                'nama_dosen' => $this->namaDosen,
                'matkul_id' => $this->matkul,
                'prodi_id' => Auth::user()->prodi_id,
                'sks' => $this->sks * $this->jumkelas,
                'akademik_tahun' => $this->tahun_ajaran . $this->sms,
                'jum_kelas' => $this->jumkelas,
                'kelas_penyesuaian' => $this->jumkelasp,
                'sks_penyesuaian' => $this->sks_penyesuaian,
                'tipe_mengajar' => $this->tipe_mengajar,
            ]);
            // dd($this->jumkelasp);
            // Alert::success('Sukses', 'Data BKD Berhasil di Tambahkan');
            // return redirect('/pddikti/data');
            Alert::success('Sukses', 'Jumlah tugas diberikan harus kurang dari jumlah pertemuan');
            return redirect('/pddikti/dosen');
        }
    }
}
