<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminReservasiController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\MahidangController;

use App\Models\Menu;
use App\Models\Fasilitas;


// ======================================================
// LOGIN ADMIN
// ======================================================

Route::get('/admin/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/admin/login', [AuthController::class, 'login'])
    ->name('admin.login');


// ======================================================
// ROUTE ADMIN - HARUS LOGIN
// ======================================================

Route::middleware('auth')->group(function () {

    // ==================================================
    // LOGOUT
    // ==================================================

    Route::post('/admin/logout', [AuthController::class, 'logout'])
        ->name('admin.logout');


    // ==================================================
    // DASHBOARD
    // ==================================================

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');


    // ==================================================
    // DATA MENU
    // ==================================================

    Route::get('/admin/menu', [MenuController::class, 'index'])
        ->name('admin.menu');

    Route::get('/admin/menu/create', [MenuController::class, 'create'])
        ->name('admin.menu.create');

    Route::post('/admin/menu', [MenuController::class, 'store'])
        ->name('admin.menu.store');

    Route::get('/admin/menu/{id}/edit', [MenuController::class, 'edit'])
        ->name('admin.menu.edit');

    Route::put('/admin/menu/{id}', [MenuController::class, 'update'])
        ->name('admin.menu.update');

    Route::delete('/admin/menu/{id}', [MenuController::class, 'destroy'])
        ->name('admin.menu.destroy');


    // ==================================================
    // DATA MEJA
    // ==================================================

    Route::get('/admin/meja', [MejaController::class, 'index'])
        ->name('admin.meja');

    Route::get('/admin/meja/create', [MejaController::class, 'create'])
        ->name('admin.meja.create');

    Route::post('/admin/meja', [MejaController::class, 'store'])
        ->name('admin.meja.store');

    Route::get('/admin/meja/{id}/edit', [MejaController::class, 'edit'])
        ->name('admin.meja.edit');

    Route::put('/admin/meja/{id}', [MejaController::class, 'update'])
        ->name('admin.meja.update');

    Route::delete('/admin/meja/{id}', [MejaController::class, 'destroy'])
        ->name('admin.meja.destroy');


    // ==================================================
    // DATA RESERVASI
    // ==================================================

    Route::get('/admin/reservasi', [AdminReservasiController::class, 'index'])
        ->name('admin.reservasi');

    Route::delete('/admin/reservasi/{id}', [AdminReservasiController::class, 'destroy'])
        ->name('admin.reservasi.destroy');


    // ==================================================
    // DATA PESANAN
    // ==================================================

    Route::get('/admin/pesanan', [PesananController::class, 'index'])
        ->name('admin.pesanan');

    Route::get('/admin/pesanan/create', [PesananController::class, 'create'])
        ->name('admin.pesanan.create');

    Route::post('/admin/pesanan', [PesananController::class, 'store'])
        ->name('admin.pesanan.store');

    Route::get('/admin/pesanan/{id}', [PesananController::class, 'show'])
        ->name('admin.pesanan.show');

    Route::delete('/admin/pesanan/{id}', [PesananController::class, 'destroy'])
        ->name('admin.pesanan.destroy');

    Route::patch('/admin/pesanan/{id}/status', [PesananController::class, 'updateStatus'])
        ->name('admin.pesanan.status');


    // ==================================================
    // DATA MAHIDANG
    // ==================================================

    Route::get('/admin/mahidang', [MahidangController::class, 'adminIndex'])
        ->name('admin.mahidang');

    Route::get('/admin/mahidang/{id}/edit', [MahidangController::class, 'edit'])
        ->name('admin.mahidang.edit');

    Route::put('/admin/mahidang/{id}', [MahidangController::class, 'update'])
        ->name('admin.mahidang.update');

    Route::delete('/admin/mahidang/{id}', [MahidangController::class, 'destroy'])
        ->name('admin.mahidang.destroy');

    // ==================================================
    // TESTIMONI
    // ==================================================

    Route::get('/admin/testimoni', [TestimoniController::class, 'index'])
        ->name('admin.testimoni');


    // ==================================================
    // LAPORAN
    // ==================================================

    Route::get('/admin/laporan', [LaporanController::class, 'index'])
        ->name('admin.laporan');


    // ==================================================
    // PENGATURAN
    // ==================================================

    Route::get('/admin/pengaturan', [PengaturanController::class, 'index'])
        ->name('admin.pengaturan');

    Route::put('/admin/pengaturan', [PengaturanController::class, 'update'])
        ->name('admin.pengaturan.update');


    // ==================================================
    // FASILITAS RUMAH MAKAN
    // ==================================================

    Route::get('/admin/fasilitas', [FasilitasController::class, 'index'])
        ->name('admin.fasilitas');

    Route::get('/admin/fasilitas/create', [FasilitasController::class, 'create'])
        ->name('admin.fasilitas.create');

    Route::post('/admin/fasilitas', [FasilitasController::class, 'store'])
        ->name('admin.fasilitas.store');

    Route::get('/admin/fasilitas/{id}/edit', [FasilitasController::class, 'edit'])
        ->name('admin.fasilitas.edit');

    Route::put('/admin/fasilitas/{id}', [FasilitasController::class, 'update'])
        ->name('admin.fasilitas.update');

    Route::delete('/admin/fasilitas/{id}', [FasilitasController::class, 'destroy'])
        ->name('admin.fasilitas.destroy');    


    // ==================================================
    // PROFIL ADMIN
    // ==================================================

    Route::get('/admin/profil', [AdminProfilController::class, 'index'])
        ->name('admin.profil');

    Route::put('/admin/profil', [AdminProfilController::class, 'update'])
        ->name('admin.profil.update');

    Route::put('/admin/profil/password', [AdminProfilController::class, 'updatePassword'])
        ->name('admin.profil.password');

});


// ======================================================
// HALAMAN UTAMA PELANGGAN
// ======================================================

Route::get('/', function () {

    $fasilitas = Fasilitas::latest()->get();

    return view('customer.home', compact('fasilitas'));

})->name('customer.home');


// ======================================================
// MENU PELANGGAN
// ======================================================

Route::get('/menu', function () {

    $menus = Menu::with('kategori')
        ->latest()
        ->get();

    return view('customer.menu', compact('menus'));

})->name('customer.menu');


// ======================================================
// MAHIDANG PELANGGAN
// ======================================================

Route::get('/mahidang', [MahidangController::class, 'create'])
    ->name('customer.mahidang');

Route::post('/mahidang', [MahidangController::class, 'store'])
    ->name('customer.mahidang.store');

// ======================================================
// RESERVASI PELANGGAN
// ======================================================

Route::get('/reservasi', [ReservasiController::class, 'index'])
    ->name('customer.reservasi');

Route::post('/reservasi', [ReservasiController::class, 'store'])
    ->name('customer.reservasi.store');


// ======================================================
// FORM PESANAN PELANGGAN
// ======================================================

Route::get('/pesanan', [PesananController::class, 'customerPesanan'])
    ->name('customer.pesanan');


// ======================================================
// SIMPAN PESANAN PELANGGAN
// ======================================================

Route::post('/pesanan', [PesananController::class, 'storeCustomer'])
    ->name('customer.pesanan.store');


// ======================================================
// STATUS PESANAN PELANGGAN
// ======================================================

Route::get('/status-pesanan', [PesananController::class, 'statusCustomer'])
    ->name('customer.status-pesanan');


// ======================================================
// RIWAYAT PELANGGAN
// ======================================================

Route::get('/riwayat', [RiwayatController::class, 'index'])
    ->name('customer.riwayat');


// ======================================================
// TESTIMONI PELANGGAN
// ======================================================

Route::get('/testimoni', [TestimoniController::class, 'create'])
    ->name('customer.testimoni');

Route::post('/testimoni', [TestimoniController::class, 'storeCustomer'])
    ->name('customer.testimoni.store');  