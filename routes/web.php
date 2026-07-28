<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\GuruKelasController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\NilaiController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\NilaiController as GuruNilaiController;
use App\Models\Nilai;
use Illuminate\Support\Facades\Route;

// auth
    // Login
    Route::get('/', [LoginController::class, 'showForm'])->name('login');
    Route::get('/masuk', [LoginController::class, 'showForm'])->name('masuk');
    Route::post('/masuk', [LoginController::class, 'login'])->name('login.proses');
    // Register
    Route::get('/daftar', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/daftar', [RegisterController::class, 'register'])->name('register.proses');
    // Logout 
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'check.role:admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/guru/{guru}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/{guru}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/{guru}', [GuruController::class, 'destroy'])->name('guru.destroy');

    
    // Menampilkan semua assignment guru dan kelas
    Route::get('/guru-kelas', [GuruKelasController::class, 'index'])->name('guruKelas.index');
    // Menampilkan daftar kelas unik
    Route::get('/kelas', [GuruKelasController::class, 'daftarKelas'])->name('guruKelas.daftarKelas');
    // Menampilkan guru yang ditugaskan pada kelas tertentu
    // Route::get('/{kelas}', [GuruKelasController::class, 'show'])->name('guruKelas.show');
    // // Menambahkan guru ke kelas
    // Route::post('/', [GuruKelasController::class, 'store'])->name('guruKelas.store');
    // // Menghapus assignment guru dari kelas
    // Route::delete('/{guruKelas}', [GuruKelasController::class, 'destroy'])->name('guruKelas.destroy');

    // Mata Pelajaran
    Route::prefix('mapel')->name('mapel.')->group(function () {
        Route::get('/', [MataPelajaranController::class, 'index'])->name('index');
        // Route::get('/create', [MataPelajaranController::class, 'create'])->name('create');
        // Route::post('/', [MataPelajaranController::class, 'store'])->name('store');
        // Route::get('/{mataPelajaran}/edit', [MataPelajaranController::class, 'edit'])->name('edit');
        // Route::put('/{mataPelajaran}', [MataPelajaranController::class, 'update'])->name('update');
        // Route::delete('/{mataPelajaran}', [MataPelajaranController::class, 'destroy'])->name('destroy');
    });


    // konfirmasi guru
    Route::get('/guru/{guru}/confirm', [GuruController::class, 'confirmation'])->name('guru.confirm');
    Route::get('/guru/{guru}/reject', [GuruController::class, 'rejected'])->name('guru.reject');

    // Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    // Nilai
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::get('/nilai/{siswa}', [NilaiController::class, 'show'])->name('nilai.show');
});

Route::middleware(['auth', 'check.role:guru'])->prefix('guru')->name('guru.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');

    // Nilai
    Route::get('/nilai', [GuruNilaiController::class, 'index'])->name('nilai.index');
    Route::post('/nilai/create', [GuruNilaiController::class, 'store'])->name('nilai.create');
    Route::get('/nilai/{nilai}/edit', [GuruNilaiController::class, 'edit'])->name('nilai.edit');
    // Route::put('/nilai/{nilai}', [GuruNilaiController::class, 'update'])->name('nilai.update');
    Route::delete('nilai/{nilai}', [NilaiController::class, 'destroy'])->name('nilai.destroy');

    // pilih kelas
    Route::post('/nilai/select-class', [GuruNilaiController::class, 'selectClass'])->name('nilai.selectClass');
});