<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard/{id}', function () {
//     return view('profile.data_pribadi');
// });

require __DIR__ . '/auth.php';

Route::get('/dashboard/{id}', [ProfilController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/add/profil', [ProfilController::class, 'formAddProfil']);
Route::post('/save/profil', [ProfilController::class, 'saveAddProfil']);
Route::get('/delete/profil/{id}/{nama}/{foto}', [ProfilController::class, 'deleteProfil']);
Route::post('/change/photo/profile/{id}', [ProfilController::class, 'changePhotoProfile']);
Route::get('/change/kepegawaian/profil/{id}', [ProfilController::class, 'formUbahKepegawaian']);
