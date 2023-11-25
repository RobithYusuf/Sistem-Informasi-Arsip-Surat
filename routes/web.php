<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\LemariController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaftarArsipController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\UserAccessMenuController;
use App\Http\Controllers\KlasifikasiArsipController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UsersController;
use App\Models\Disposisi;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/proseslogin', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    Route::resource('access_menu', UserAccessMenuController::class);
    Route::resource('menu', UserMenuController::class);
    Route::resource('sub_menu', SubmenuController::class);
    Route::resource('data-rak', RakController::class);
    Route::resource('data-lemari', LemariController::class);
    Route::resource('data-folder', FolderController::class);
    Route::resource('arsip', ArsipController::class);
    Route::resource('klasifikasi-arsip', KlasifikasiArsipController::class);
    Route::resource('daftar-arsip', DaftarArsipController::class);
    Route::resource('disposisi', DisposisiController::class);
    Route::resource('users', UsersController::class);
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::resource('laporan', LaporanController::class);
});

Route::middleware(['role:arsiparis'])->prefix('arsiparis')->name('arsiparis.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'arsiparis'])->name('dashboard');
    Route::resource('data-rak', RakController::class);
    Route::resource('data-lemari', LemariController::class);
    Route::resource('data-folder', FolderController::class);
    Route::resource('arsip', ArsipController::class);
    Route::resource('klasifikasi-arsip', KlasifikasiArsipController::class);
    Route::resource('daftar-arsip', DaftarArsipController::class);
    Route::resource('disposisi', DisposisiController::class);
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::resource('laporan', LaporanController::class);
});

Route::middleware(['role:direktur'])->prefix('direktur')->name('direktur.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'direktur'])->name('dashboard');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::resource('laporan', LaporanController::class);
});
Route::middleware(['role:user'])->prefix('users')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'user'])->name('dashboard');
});
