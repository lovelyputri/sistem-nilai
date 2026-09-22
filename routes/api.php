<?php

use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\GuruKelasController;
use App\Http\Controllers\Admin\NilaiController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Guru\NilaiController as GuruNilaiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes — Sistem Nilai
|--------------------------------------------------------------------------
| Base URL: http://127.0.0.1:8000/api
| Tidak perlu auth session — cocok untuk Postman.
|--------------------------------------------------------------------------
*/

// ========================
// GURU — CRUD
// ========================
Route::prefix('guru')->group(function () {
    Route::get('/',                 [GuruController::class, 'index']);        // GET    /api/guru
    Route::post('/',                [GuruController::class, 'store']);        // POST   /api/guru
    Route::put('/{guru}',           [GuruController::class, 'update']);       // PUT    /api/guru/{id}
    Route::delete('/{guru}',        [GuruController::class, 'destroy']);      // DELETE /api/guru/{id}
    Route::patch('/{guru}/confirm', [GuruController::class, 'confirmation']); // PATCH  /api/guru/{id}/confirm
    Route::patch('/{guru}/reject',  [GuruController::class, 'rejected']);     // PATCH  /api/guru/{id}/reject
});

// Helper: daftar mata pelajaran
Route::get('/mata-pelajaran', [GuruController::class, 'mataPelajaran']);      // GET /api/mata-pelajaran

// ========================
// SISWA — CRUD
// ========================
Route::prefix('siswa')->group(function () {
    Route::get('/',           [SiswaController::class, 'index']);    // GET    /api/siswa?kelas=X-A
    Route::post('/',          [SiswaController::class, 'store']);    // POST   /api/siswa
    Route::put('/{siswa}',    [SiswaController::class, 'update']);   // PUT    /api/siswa/{id}
    Route::delete('/{siswa}', [SiswaController::class, 'destroy']);  // DELETE /api/siswa/{id}
});

// ========================
// NILAI — Admin & Guru
// ========================
Route::prefix('nilai')->group(function () {
    Route::get('/',           [NilaiController::class, 'index']);         // GET    /api/nilai  (rekap semua)
    Route::get('/{siswa}',    [NilaiController::class, 'show']);          // GET    /api/nilai/{id_siswa}
    Route::post('/',          [GuruNilaiController::class, 'store']);     // POST   /api/nilai  (input nilai, body: id_user, id_siswa, nilai)
    Route::put('/{nilai}',    [GuruNilaiController::class, 'update']);    // PUT    /api/nilai/{id}
    Route::delete('/{nilai}', [GuruNilaiController::class, 'destroy']);   // DELETE /api/nilai/{id}
});

// ========================
// GURU-KELAS — Fitur Baru
// Admin dapat menugaskan guru ke kelas manapun, lebih dari 1 guru per kelas
// ========================
Route::prefix('guru-kelas')->group(function () {
    Route::get('/',               [GuruKelasController::class, 'index']);        // GET    /api/guru-kelas
    Route::get('/kelas',          [GuruKelasController::class, 'daftarKelas']);  // GET    /api/guru-kelas/kelas
    Route::get('/{kelas}',        [GuruKelasController::class, 'show']);         // GET    /api/guru-kelas/{nama_kelas}
    Route::post('/',              [GuruKelasController::class, 'store']);        // POST   /api/guru-kelas
    Route::delete('/{guruKelas}', [GuruKelasController::class, 'destroy']);     // DELETE /api/guru-kelas/{id}
});
