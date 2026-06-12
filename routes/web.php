<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\InformasiWebController;
use App\Http\Controllers\MenuKategoriController;
use App\Http\Controllers\PelangganController;

// Home route
Route::get('/', function () {
    $info = \App\Models\InformasiWeb::first();
    return view('welcome', ['info' => $info]);
})->name('home');

// Auth routes
Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Alias routes for convenience
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin login routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');
});

// Public pages (no auth required)
Route::get('/tentang', function () {
    $info = \App\Models\InformasiWeb::first();
    return view('tentang', ['info' => $info]);
})->name('tentang');

Route::get('/menu', function () {
    $kategori = request('kategori', 'semua');
    $query = \App\Models\Menu::query();
    
    if ($kategori === 'Makanan') {
        $query->whereIn('kategori', ['Rice Bowl', 'Munchies', 'Nugi Burger', 'Hotdog', 'Salad', 'Toast', 'Additional (Food)']);
    } elseif ($kategori === 'Minuman') {
        $query->whereIn('kategori', ['Coffee', 'Non Coffee', 'Signature', 'Milkshake', 'Tea', 'Fizzy Breeze', 'Smoothies', 'Additional (Drinks)']);
    } elseif ($kategori !== 'semua') {
        $query->where('kategori', $kategori);
    }
    
    $menus = $query->orderBy('position', 'asc')->get();
    return view('menu', ['menus' => $menus, 'kategori' => $kategori]);
})->name('menu');

Route::get('/semua-menu', function () {
    return redirect()->route('menu');
})->name('semua-menu');

Route::get('/galeri', function () {
    $galeri = \App\Models\Galeri::all();
    $info = \App\Models\InformasiWeb::first();
    return view('galeri', ['galeri' => $galeri, 'info' => $info]);
})->name('galeri');

Route::get('/lokasi', function () {
    $info = \App\Models\InformasiWeb::first();
    return view('lokasi', ['info' => $info]);
})->name('lokasi');

// Pelanggan dashboard (authenticated customers)
Route::middleware(['auth'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [PelangganController::class, 'dashboard'])->name('dashboard');
    Route::get('/reservasi', [PelangganController::class, 'reservasi'])->name('reservasi');
    Route::post('/reservasi/{id}/cancel', [PelangganController::class, 'cancelReservasi'])->name('reservasi.cancel');
});

// Pelanggan reservation (auth required)
Route::middleware(['auth'])->group(function () {
    // Multi-step reservation
    Route::get('/reservasi', [ReservasiController::class, 'step1'])->name('reservasi.step1');
    Route::get('/reservasi/check-available', [ReservasiController::class, 'checkAvailableTables'])->name('reservasi.check');
    Route::post('/reservasi/step2', [ReservasiController::class, 'step2'])->name('reservasi.step2');
    Route::post('/reservasi/step3', [ReservasiController::class, 'step3'])->name('reservasi.step3');
    Route::post('/reservasi/step4', [ReservasiController::class, 'step4'])->name('reservasi.step4');
    Route::post('/reservasi/payment', [ReservasiController::class, 'payment'])->name('reservasi.payment');
    Route::get('/reservasi/success/{id}', [ReservasiController::class, 'success'])->name('reservasi.success');
    Route::get('/reservasi/invoice/{id}', [ReservasiController::class, 'printInvoice'])->name('reservasi.invoice');
    
    // Legacy routes (kept for backward compatibility)
    Route::get('/reservasi/create', [ReservasiController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi-store', [ReservasiController::class, 'store'])->name('reservasi.store');
});

// Admin dashboard and management (protected)
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/reservasi/report', [DashboardController::class, 'reservasiReport'])->name('admin.reservasi.report');
    Route::get('/admin/reservasi/export', [DashboardController::class, 'exportPage'])->name('admin.reservasi.export');
    Route::get('/admin/reservasi/export/download', [DashboardController::class, 'exportDownload'])->name('admin.reservasi.export.download');

    // Resource routes (prefixed with /admin)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::post('menu/reorder', [MenuController::class, 'reorder'])->name('menu.reorder');
        Route::resource('menu', MenuController::class);
        Route::post('menu-kategori', [MenuKategoriController::class, 'store'])->name('menu-kategori.store');
        Route::delete('menu-kategori/{id}', [MenuKategoriController::class, 'destroy'])->name('menu-kategori.destroy');
        Route::resource('galeri', GaleriController::class);
        Route::resource('meja', MejaController::class);
        Route::resource('reservasi', ReservasiController::class, ['except' => ['create', 'store']]);
        Route::resource('informasi-web', InformasiWebController::class);
        Route::put('informasi-web/landing/update', [InformasiWebController::class, 'updateLanding'])->name('informasi-web.landing.update');

        // Reservation actions
        Route::post('/reservasi/{id}/approve', [ReservasiController::class, 'approve'])->name('reservasi.approve');
        Route::post('/reservasi/{id}/reject', [ReservasiController::class, 'reject'])->name('reservasi.reject');
        Route::post('/reservasi/{id}/complete', [ReservasiController::class, 'complete'])->name('reservasi.complete');

        // Change password routes
        Route::get('password', [AuthController::class, 'showChangePassword'])->name('password.edit');
        Route::put('password', [AuthController::class, 'changePassword'])->name('password.update');
    });
});
