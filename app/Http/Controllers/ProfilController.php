<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use Illuminate\Support\Facades\File;
use Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    // Menampilkan data pribadi dosen ber-NIDN atau non-NIDN
    public function index($id)
    {
        $profil = new Profil();

        $get_profil = $profil::where('user_profile', $id)->get();

        return view('profile.data_pribadi', [
            'profil' => $get_profil,
        ]);
    }

    // Menampilkan data pribadi dosen ber-NIDN atau non-NIDN
    public function formAddProfil()
    {

        return view('profile.add_profil');
    }

    public function saveAddProfil(Request $request)
    {

        $rules = [
            'foto'    => 'mimes:jpeg,jpg,png|required|max:10000', // max 10 MB
        ];
        $messages = [
            'foto.mimes'        => 'File  harus berformat png, jpeg, atau jpg',
            'foto.required'     => 'File harus di upload',
            'foto.max'          => 'Size File Terlalu Besar, Max.10MB',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            toast("Error " . $validator->errors()->first(), 'error');
            return redirect()->back();
        } else {
            $profil = new Profil();
            // Foto Profil
            $foto = Request()->foto;

            $path = public_path() . '/foto/profil/' . '/' . $request->nama;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, false);
            }
            $namaFile = rand() . '_' . $request->nama . '.' . $foto->extension();
            $foto->move(public_path('assets/images/foto/profil/' . '/' . $request->nama),  $namaFile);

            $pengenal = $request->jenispengenal;

            $profil->id = null;

            if ($pengenal == "NIDN") {
                $profil->nidn = $request->idpengenal;
                $profil->nidk = "";
                $profil->nup = "";
            } elseif ($pengenal == "NIDK") {
                $profil->nidk = $request->idpengenal;
                $profil->nidn = "";
                $profil->nup = "";
            } elseif ($pengenal == "NUP") {
                $profil->nup = $request->idpengenal;
                $profil->nidn = "";
                $profil->nidk = "";
            }

            $profil->foto = $namaFile;

            $profil->nama = $request->nama;
            $profil->jenkel = $request->jenkel;
            $profil->tempat_lahir = $request->tempatlahir;
            $profil->tanggal_lahir = $request->tanggallahir;

            $profil->nik = $request->nik;
            $profil->npwp = $request->npwp;
            $profil->kewarganegaraan = $request->warganegara;
            $profil->program_studi = $request->prodi;

            $profil->nohp = $request->nohp;
            $profil->email = $request->email;
            $profil->status_isi = "LENGKAP";
            $profil->user_profile = Auth::user()->id;

            $profil->save();

            toast("Profil kamu berhasil dilengkapi", 'success');
            return redirect('/dashboard/' . Auth::user()->id);
        }
    }

    public function deleteProfil($id, $nama, $foto)
    {
        $profil = new Profil();
        if (File::exists(public_path('assets/images/foto/profil/' . $nama . '/' . $foto))) {
            File::delete(public_path('assets/images/foto/profil/' . $nama . '/' . $foto));
            $profil = Profil::find($id);
            $profil->delete();
            toast("Profil kamu berhasil dihapus", 'success');
            return redirect('/dashboard/' . Auth::user()->id);
        } else {
            dd('File does not exists.');
        }
    }

    public function changePhotoProfile(Request $request, $id)
    {
        $profil = new Profil();
        $getNama = $profil::where('user_profile', $id)->get();
        foreach ($getNama as $data) {
            $nama = $data->nama;
            $fotoLama = $data->foto;
        }

        $rules = [
            'fotoganti'    => 'mimes:jpeg,jpg,png|required|max:10000', // max 10 MB
        ];
        $messages = [
            'fotoganti.mimes'        => 'File  harus berformat png, jpeg, atau jpg',
            'fotoganti.required'     => 'File harus di upload',
            'fotoganti.max'          => 'Size File Terlalu Besar, Max.10MB',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            toast("Error " . $validator->errors()->first(), 'error');
            return redirect()->back();
        } else {

            // Foto Profil
            $foto = Request()->fotoganti;

            // Hapus foto
            if (File::exists(public_path('assets/images/foto/profil/' . $nama . '/' . $fotoLama))) {
                File::delete(public_path('assets/images/foto/profil/' . $nama . '/' . $fotoLama));
                $profil = Profil::find($id);
                $profil->delete();
            }

            // Update Foto
            $path = public_path() . '/foto/profil/' . '/' . $request->nama;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, false);
            }
            $namaFile = rand() . '_' . $nama . '.' . $foto->extension();
            $foto->move(public_path('assets/images/foto/profil/' . '/' . $nama),  $namaFile);


            $profil::where('user_profile', $id)
                ->update(['foto' => $namaFile]);

            toast("Foto profil kamu berhasil diupdate", 'success');
            return redirect('/dashboard/' . Auth::user()->id);
        }
    }

    public function formUbahKepegawaian($id)
    {
        $profil = new Profil();

        $get_profil = $profil::where('user_profile', $id)->get();

        return view('profile.update_kepegawaian', [
            'profil' => $get_profil,
        ]);
    }
    public function processUpdateKepegawaian(Request $request, $id)
    {
        $profil = new Profil();
        $profil::where('user_profile', $id)
            ->update([
                'program_studi' => $request->prodi,
                'nohp' => $request->nohp,
                'email' => $request->email
            ]);

        toast("Data Kepegawaian kamu berhasil diupdate", 'success');
        return redirect('/dashboard/' . Auth::user()->id);
    }
}
