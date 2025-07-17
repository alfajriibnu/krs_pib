<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dosen\DashboardController as DosenDashboardController;
use App\Http\Controllers\Dosen\DosenKrsController;
use App\Http\Controllers\Dosen\DosenProfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\KrsController;
use App\Http\Controllers\Mahasiswa\ProfilMahasiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // ...route prodi, mahasiswa, dst
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('prodi', ProdiController::class)->except(['show']);
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('dosen', DosenController::class)->except(['show']);
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('mahasiswa', MahasiswaController::class)->except(['show']);
});

// Mata Kuliah
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::resource('matakuliah', \App\Http\Controllers\Admin\MataKuliahController::class)->except('show');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('tahunakademik', App\Http\Controllers\Admin\TahunAkademikController::class);
});

Route::middleware(['auth', 'mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('profil', [ProfilMahasiswaController::class, 'edit'])->name('profil.edit');
    Route::put('profil', [ProfilMahasiswaController::class, 'update'])->name('profil.update');
    Route::put('profil/password', [ProfilMahasiswaController::class, 'updatePassword'])->name('profil.updatePassword');
});


Route::prefix('mahasiswa')->middleware(['auth'])->name('mahasiswa.')->group(function () {
    Route::get('krs', [KRSController::class, 'index'])->name('krs.index');
    Route::post('krs', [KRSController::class, 'store'])->name('krs.store');
    Route::put('krs/{krs}/ajukan', [KRSController::class, 'ajukan'])->name('krs.ajukan'); // ✅ Tambahkan ini

    // ⬇ Tambahkan ini untuk cetak PDF
    Route::get('krs/{krs}/cetak', [KrsController::class, 'cetak'])->name('krs.cetak');
});

Route::middleware(['auth', 'dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('dashboard', [DosenDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('profil', [DosenProfilController::class, 'edit'])->name('profil');
    Route::put('profil/password', [DosenProfilController::class, 'updatePassword'])->name('profil.updatePassword');
});


Route::middleware(['auth', 'dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('krs', [DosenKrsController::class, 'index'])->name('krs.index');
    Route::get('krs/{krs}', [DosenKrsController::class, 'show'])->name('krs.show');
    Route::put('krs/{krs}/verifikasi', [DosenKrsController::class, 'verifikasi'])->name('krs.verifikasi');
});

Route::middleware(['auth', 'mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('krs/riwayat', [KrsController::class, 'riwayat'])->name('krs.riwayat');
});


// routes/web.php
Route::get('/get-dosen-by-prodi/{id}', function ($id) {
    return \App\Models\Dosen::where('prodi_id', $id)->get(['id', 'nama']);
})->middleware('auth');
