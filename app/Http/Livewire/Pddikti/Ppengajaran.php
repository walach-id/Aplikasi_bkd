<?php

namespace App\Http\Livewire\Pddikti;

use Livewire\Component;
use App\Models\User;
use App\Models\Profil;
use App\Models\MataKuliah;
use App\Models\Krs;
use App\Models\DosenNidn;
use App\Models\tahun_akademiks;
use App\Models\DaftarDosenDikti;
use App\Models\DaftarDosenHonor;
use App\Models\DosenJson;
use App\Models\PddiktiPengajaran;
use App\Models\HonorPengajaran;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;
use App\Imports\PengajaranImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class Ppengajaran extends Component
{
    public $matkul;
    public $prodi;
    public $sks;
    public $jumkelas;
    public $jumkelasp;
    public $tahun_ajaran;
    public $sms;
    public $rasio;
    public $tipe_dosen_pengajaran;
    public $no_induk;
    public $bio_dosen;
    public $tipe_mengajar;

    //variable list for autocomplete
    public $listDosen = [];
    public $listDosenAnggota = [];
    public $listDosenHonor = [];
    public $listDosenHonorAnggota = [];
    public $listDosenAnggotaTerpilih = [];
    public $listDosenHonorAnggotaTerpilih = [];

    //dosen utama
    public $namaDosen;
    public $idDosen;

    //dosen anggota
    public $namaDosenAnggota;
    public $idDosenAnggota;

    //dosen honor
    public $namaDosenHonor;
    public $idDosenHonor;

    //dosen Honor anggota
    public $namaDosenHonorAnggota;
    public $idDosenHonorAnggota;

    public $matkul_jenis;
    public $jenis_dosen_honor;
    public $matkul_jenis_honor;
    public $jenis_dosen;

    // rules buat data yang didapet, harus ada, gak tau dari package liveware autocompletenya ini 😞
    protected $rules = [
        // DOSEN UNTUK PDDIKTI
        'listDosen.*.nama' => '',
        'listDosen.*.no_registrasi' => '',
        'listDosenAnggota.*.nama' => '',
        'listDosenAnggota.*.no_registrasi' => '',

        // DOSEN UNTUK HONOR
        'listDosenHonor.*.nama_dosen' => '',
        'listDosenHonor.*.kode_dosen' => '',
        'listDosenHonorAnggota.*.nama_dosen' => '',
        'listDosenHonorAnggota.*.kode_dosen' => '',
    ];


    //Hook lifecycle livewire, respond to variable value change updated[VarName]

    //pakai getDosen
    public function updatedNamaDosen()
    {
        $this->getDosen($this->listDosen, $this->namaDosen);
    }

    public function updatedNamaDosenAnggota()
    {
        $this->getDosen($this->listDosenAnggota, $this->namaDosenAnggota);
    }

    //pakai getDosen end

    //pakai getDosenHonor end
    public function updatedNamaDosenHonor()
    {
        $this->getDosenHonor($this->listDosenHonor, $this->namaDosenHonor);
    }

    public function updatedNamaDosenHonorAnggota()
    {
        $this->getDosenHonor($this->listDosenHonorAnggota, $this->namaDosenHonorAnggota);
    }

    public function updatedIdDosenAnggota()
    {
        $this->listDosenAnggotaTerpilih += ['"' . $this->idDosenAnggota . '"' => $this->namaDosenAnggota];
        $this->idDosenAnggota = null;
        $this->namaDosenAnggota = null;
    }

    public function updatedIdDosenHonorAnggota()
    {
        $this->listDosenHonorAnggotaTerpilih += ['"' . $this->idDosenHonorAnggota . '"' => $this->namaDosenHonorAnggota];
        $this->idDosenHonorAnggota = null;
        $this->namaDosenHonorAnggota = null;
    }

    // public function updatedIdDosenHonor()
    // {
    //     $this->listDosenHonorAnggotaTerpilih += [$this->idDosenHonorAnggota => $this->namaDosenHonorAnggota];
    //     $this->idDosenHonorAnggota = null;
    //     $this->namaDosenHonorAnggota = null;
    // }

    //Hook lifecycle livewire end

    public function removeFromMulti($idp)
    {
        unset($this->listDosenAnggotaTerpilih['"' . $idp . '"']);
    }

    public function removeFromMultiHonor($id)
    {
        unset($this->listDosenHonorAnggotaTerpilih['"' . $id . '"']);
    }


    public function getDosen(&$arrayList, &$name)
    {
        if (!empty($name) || $name !== null) {
            $arrayList = DosenNidn::query()
                ->when($name, function ($query, $name) {
                    return $query->where('nama', 'LIKE', '%' . $name . '%');
                })
                ->orderBy('nama')
                ->limit(10)
                ->get();
        } else {
            $arrayList = [];
        }
    }


    public function getDosenHonor(&$arrayList, &$name)
    {
        if (!empty($name) || $name !== null) {
            $arrayList = DosenJson::query()
                ->when($name, function ($query, $name) {
                    return $query->where('nama_dosen', 'LIKE', '%' . $name . '%');
                })
                ->orderBy('nama_dosen')
                ->limit(10)
                ->get();
        } else {
            $arrayList = [];
        }
    }

    public function render()
    {
        $tahun_akademik = tahun_akademiks::get();
        $data_prodi = ProgramStudi::get();
        //Ambil seluruh data matkul
        $listMatkul = MataKuliah::where('id_prodi', '=', Auth::user()->prodi_id)
            ->where('thn_akademik', '=', $this->tahun_ajaran)
            ->OrderBy('nama_mk', 'ASC')->get();

        //$this->sks_penyesuaian = $this->sks * $this->jumkelasp;
        if ($this->sks == null || $this->jumkelasp == null) {
            $this->sks_penyesuaian = 0;
        } else {
            $this->sks_penyesuaian = $this->sks * $this->jumkelasp;
        }

        $banyak_mahasiswa = krs::where('id_prodi', '=', Auth::user()->prodi_id)
            ->where('kode_mk', '=', $this->matkul)
            ->where('thn_akademik', '=', $this->tahun_ajaran)
            ->count();

        $select_sks = MataKuliah::where('id_prodi', '=', Auth::user()->prodi_id)
            ->where('thn_akademik', '=', $this->tahun_ajaran)
            ->where('kode_mk', '=', $this->matkul)
            ->first();


        if ($this->matkul == "" || ($this->tahun_ajaran == "")) {
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
            'tahun' => $tahun_akademik,
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
        $this->matkul = "";
        $this->sks = "";
        $this->jumkelas = "";
        $this->jumkelasp = "";
    }

    public function storePpengajaran()
    {

        $id_pengajaran_dikti_honor = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);

        // Menyimpan ke tabel pengajaran_honor

        foreach ($this->listDosenHonor as $dosen) {
            $nik_dosen_pj_honor = $dosen->kode_dosen;
        }

        HonorPengajaran::create([
            'id_pengajaran_honor' => $id_pengajaran_dikti_honor,
            'matkul_id' => $this->matkul,
            'prodi_id' => Auth::user()->prodi_id,
            'sks' => $this->sks * $this->jumkelas,
            'akademik_tahun' => $this->tahun_ajaran,
            'jum_kelas' => $this->jumkelasp,
            'jum_mengajar' => 14,
            'tipe_mengajar' => $this->matkul_jenis_honor,
        ]);

        if ($this->matkul_jenis_honor === "Kelompok") {
            foreach ($this->listDosenHonorAnggotaTerpilih as $kodeDosen => $nama) {

                DaftarDosenHonor::create([
                    'id_pengajaran_honor' => $id_pengajaran_dikti_honor,
                    'dosen' => $nik_dosen_pj_honor,
                    'dosen_anggota' =>  str_replace('"', "", $kodeDosen),
                ]);
            }
        } else {
            DaftarDosenHonor::create([
                'id_pengajaran_honor' => $id_pengajaran_dikti_honor,
                'dosen' => $nik_dosen_pj_honor,
                'dosen_anggota' =>  "-",
            ]);
        }
        // Menyimpan ke tabel pengajaran_pddikti

        PddiktiPengajaran::create([
            'id_pengajaran_pddikti' => $id_pengajaran_dikti_honor,
            'matkul_id' => $this->matkul,
            'prodi_id' => Auth::user()->prodi_id,
            'sks' => $this->sks * $this->jumkelas,
            'akademik_tahun' => $this->tahun_ajaran,
            'jum_kelas' => $this->jumkelas,
            'jum_mengajar' => 14,
            'tipe_mengajar' => $this->matkul_jenis,
        ]);

        if ($this->tipe_dosen_pengajaran == 1) { // JIKA ISIAN DOSEN DI SAMAKAN


            if ($this->matkul_jenis_honor === "Kelompok") {
                foreach ($this->listDosenHonorAnggotaTerpilih as $kodeDosen => $nama) {
                    // dd($nama);
                    DaftarDosenDikti::create([
                        'id_pengajaran_pddikti' => $id_pengajaran_dikti_honor,
                        'dosen' => $nik_dosen_pj_honor,
                        'dosen_anggota' => str_replace('"', "", $kodeDosen),
                    ]);
                }
            } else {
                DaftarDosenDikti::create([
                    'id_pengajaran_pddikti' => $id_pengajaran_dikti_honor,
                    'dosen' => $nik_dosen_pj_honor,
                    'dosen_anggota' =>  "-",
                ]);
            }
        } else {

            foreach ($this->listDosen as $dosen) {
                $nik_dosen_pj_pddikti = $dosen->no_registrasi;
            }
            if ($this->matkul_jenis === "Kelompok") {
                foreach ($this->listDosenAnggotaTerpilih as $nik => $nama) {
                    // dd($nama);
                    DaftarDosenDikti::create([
                        'id_pengajaran_pddikti' => $id_pengajaran_dikti_honor,
                        'dosen' => $nik_dosen_pj_pddikti,
                        'dosen_anggota' =>  str_replace('"', "", $nik),
                    ]);
                }
            } else {
                DaftarDosenDikti::create([
                    'id_pengajaran_pddikti' => $id_pengajaran_dikti_honor,
                    'dosen' => $nik_dosen_pj_pddikti,
                    'dosen_anggota' =>  "-",
                ]);
            }
        }

        Alert::success('Sukses', 'Jumlah tugas diberikan harus kurang dari jumlah pertemuan');
    }
}
