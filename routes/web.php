<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginSiswaController;

use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasPesertaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminAbsensiController;

use App\Http\Controllers\Guru\KelasGuruController;
use App\Http\Controllers\Guru\AbsensiGuruController;

/*
|--------------------------------------------------------------------------
| HALAMAN UMUM
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'));

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT (ROLE BASED)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    if (!$user) {
        return redirect()->route('login');
    }

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'guru'  => redirect()->route('guru.dashboard'),
        'siswa' => redirect()->route('siswa.dashboard'),
        default => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('siswa', SiswaController::class);
        Route::resource('data-guru', DataGuruController::class);
        Route::resource('kelas', KelasController::class);

        Route::get('/kelas/{kelas}/peserta', [KelasPesertaController::class, 'index'])
            ->name('kelas.peserta');
        Route::post('/kelas/{kelas}/peserta', [KelasPesertaController::class, 'store'])
            ->name('kelas.peserta.store');

        Route::get('/absensi', [AdminAbsensiController::class, 'index'])
            ->name('absensi.index');
        Route::get('/absensi/export/pdf', [AdminAbsensiController::class, 'exportPdf'])
            ->name('absensi.export.pdf');
        Route::get('/absensi/export/excel', [AdminAbsensiController::class, 'exportExcel'])
            ->name('absensi.export.excel');
    });

/*
|--------------------------------------------------------------------------
| GURU
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        Route::get('/dashboard', [GuruController::class, 'index'])
            ->name('dashboard');

        Route::get('/kelas', [KelasGuruController::class, 'index'])
            ->name('kelas.index');
        Route::get('/kelas/create', [KelasGuruController::class, 'create'])
            ->name('kelas.create');
        Route::post('/kelas', [KelasGuruController::class, 'store'])
            ->name('kelas.store');

        Route::get('/kelas/{kelas}/edit', [KelasGuruController::class, 'edit'])
            ->name('kelas.edit');
        Route::put('/kelas/{kelas}', [KelasGuruController::class, 'update'])
            ->name('kelas.update');
        Route::delete('/kelas/{kelas}', [KelasGuruController::class, 'destroy'])
            ->name('kelas.destroy');

        Route::get('/kelas/{kelas}/peserta', [KelasGuruController::class, 'peserta'])
            ->name('kelas.peserta');
        Route::post('/kelas/{kelas}/peserta', [KelasGuruController::class, 'simpanPeserta'])
            ->name('kelas.peserta.store');

        Route::get('/absensi', [AbsensiGuruController::class, 'index'])
            ->name('absensi.index');
    });

/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::post('/absen/{kelas}', [AbsensiController::class, 'store'])
            ->name('absen.store');
    });
