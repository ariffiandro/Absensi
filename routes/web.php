<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LoginSiswaController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasPesertaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminAbsensiController;
use App\Http\Controllers\Guru\KelasGuruController;
use App\Http\Controllers\Guru\AbsensiGuruController;


use Illuminate\Support\Facades\Artisan;

// Halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// Dashboard redirect sesuai role
Route::get('/dashboard', function () {
    $user = auth()->user();
    if (!$user) return redirect()->route('login'); // aman jika belum login

    return match($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'guru'  => redirect()->route('guru.dashboard'),
        'siswa' => redirect()->route('siswa.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// ================= AUTH ROUTES ================= //

// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

// ================= PROFILE ================= //
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================= DASHBOARD PER ROLE ================= //

// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

});

// Data Siswa
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('siswa', SiswaController::class);
});

// SISWA
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/dashboard-siswa', [LoginSiswaController::class, 'index'])
    ->name('siswa.dashboard');
});

// Data Guru / Wali Kelas
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('data_guru', DataGuruController::class);
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('kelas', KelasController::class);

    Route::get('/kelas/{kelas}/peserta', [KelasPesertaController::class,'index'])
        ->name('kelas.peserta');
    Route::post('/kelas/{kelas}/peserta', [KelasPesertaController::class,'store'])
        ->name('kelas.peserta.store');

});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::post('/absen/{kelas}', [AbsensiController::class, 'store'])
        ->name('absen.store');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/dashboard-siswa', [DashboardController::class, 'index'])
        ->name('siswa.dashboard');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/absensi', [AdminAbsensiController::class, 'index'])
        ->name('admin.absensi.index');

    Route::get('/admin/absensi/export/pdf', [AdminAbsensiController::class, 'exportPdf'])
        ->name('admin.absensi.export.pdf');

    Route::get('/admin/absensi/export/excel', [AdminAbsensiController::class, 'exportExcel'])
        ->name('admin.absensi.export.excel');
});

Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        Route::get('/dashboard', fn () => view('guru.dashboard'))->name('dashboard');

        Route::get('/kelas-guru', [KelasGuruController::class, 'index'])->name('kelas.index');
        Route::get('/kelas/create', [KelasGuruController::class, 'create'])->name('kelas.create');
        Route::post('/kelas', [KelasGuruController::class, 'store'])->name('kelas.store');

        Route::get('/absensi', [AbsensiGuruController::class, 'index'])->name('absensi.index');
    });

Route::prefix('guru')->middleware(['auth','role:guru'])->group(function () {

    Route::get('/kelas/{kelas}/edit', [KelasGuruController::class, 'edit'])->name('guru.kelas.edit');
    Route::put('/kelas/{kelas}', [KelasGuruController::class, 'update'])->name('guru.kelas.update');

    Route::delete('/kelas/{kelas}', [KelasGuruController::class, 'destroy'])->name('guru.kelas.destroy');

    Route::get('/kelas/{kelas}/peserta', [KelasGuruController::class, 'peserta'])->name('guru.kelas.peserta');
    Route::post('/kelas/{kelas}/peserta', [KelasGuruController::class, 'simpanPeserta'])->name('guru.kelas.peserta.store');
});

Route::get('/init-db-absensi', function () {
    Artisan::call('migrate:fresh --force');
    Artisan::call('db:seed --force');

    return 'DATABASE SUKSES DI-INISIALISASI';
});