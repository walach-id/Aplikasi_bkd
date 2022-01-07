<?php

use App\Http\Controllers\PddiktiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PengajaranController;
use App\Http\Controllers\PpengajaranController;
use App\Http\Controllers\DosenHonorController;
use App\Http\Controllers\DosenPddiktiController;
use App\Imports\PengajaranImport;
use App\Models\HonorPengajaran;
use Maatwebsite\Excel\Facades\Excel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pddikti/dosen/json', [PddiktiController::class, 'dataAjax']);

Route::get('/pddikti', [PddiktiController::class, 'tampilFormTambah']);

// Route::get('/pddikti/dosen', function () {
//     return view('pddikti.data_dosen_pddikti');
// });
// Route::get('/pddikti/dosen/detail/{id}/alihkan', function () {
//     return view('pddikti.update_pengajaran_pddikti');
// });

Route::get('/contoh', function () {
    return view('pddikti.detail_dosen_pddikti');
});
Route::get('/pddikti/dosen', [DosenPddiktiController::class, 'index']);
Route::get('/pddikti/dosen/detail/{id}', [DosenPddiktiController::class, 'detail']);

// Route::get('/pddikti/dosen/detail/{id}', [PddiktiController::class, 'index']);

//pddikti
Route::get('/pddikti/form', [PpengajaranController::class, 'formAddPpengajaran']);
Route::post('/pddikti/form/add', [PpengajaranController::class, 'storePpengajaran']);
Route::post('/pddikti/form/import', function () {
    Excel::import(new PengajaranImport, request()->file('file'));
    return back();
});
// Route::get('/pddikti/data', [PpengajaranController::class, 'index']);
Route::get('/pddikti/pengajaran', [PpengajaranController::class, 'tampil_pengajaran']);
Route::get('/pddikti/pengajaran/cetak', [PpengajaranController::class, 'cetakpddikti']);
Route::get('/pddikti/pengajaran/cetak/{id}', [PddiktiController::class, 'cetakDetailPddikti']);


Route::get('/honor/data', [DosenHonorController::class, 'index']);
Route::get('/honor/data/detail/{id}', [DosenHonorController::class, 'detail']);
// Route::get('/dashboard/{id}', function () {
//     return view('profile.data_pribadi');
// });

Route::get('/dashboard', [ProfilController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/add/profil', [ProfilController::class, 'formAddProfil']);
    Route::post('/save/profil', [ProfilController::class, 'saveAddProfil']);
    Route::get('/delete/profil/{id}/{nama}/{foto}', [ProfilController::class, 'deleteProfil']);
    Route::post('/change/photo/profile/{id}', [ProfilController::class, 'changePhotoProfile']);

    Route::get('/change/kepegawaian/profil/{id}', [ProfilController::class, 'formUbahKepegawaian']);
    Route::post('/update/kepegawaian', [ProfilController::class, 'processUpdateKepegawaian']);

    Route::get('/change/kependudukan/profil/{id}', [ProfilController::class, 'formUbahKependudukan']);
    Route::post('/update/kependudukan', [ProfilController::class, 'processUpdateKependudukan']);

    Route::get('/change/profil/{id}', [ProfilController::class, 'formUbahProfil']);
    Route::post('/update/profil', [ProfilController::class, 'processUpdateProfil']);
    Route::get('/pengajaran', [PengajaranController::class, 'index']);
    Route::get('/pengajaran/add', [PengajaranController::class, 'formAddPengajaran']);
    Route::get('/pengajaran/cetak', [PengajaranController::class, 'cetakPDF']);
});

// Pengajaran BKD
Route::get('/bkd', [PengajaranController::class, 'index']);
Route::post('/bkd', [PengajaranController::class, 'storePengajaran']);

Route::get('/bkd/form', [PengajaranController::class, 'formAddPengajaran']);
Route::get('/bkd/detail/{id}', [PengajaranController::class, 'detailBKD']);
