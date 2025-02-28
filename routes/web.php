<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KosController;

use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth', [AuthController::class, 'auth']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/setting', [AuthController::class, 'setting']);
Route::post('/edituser', [AuthController::class, 'edituser']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/settings', [SettingsController::class, 'showSettingsForm'])->name('settings.form');
Route::post('/settings', [SettingsController::class, 'saveSettings'])->name('settings.save');
Route::get('/convert-and-store-timestamp', [SettingsController::class, ' convertAndStoreTimestamp'])->name('settings.convert');

Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan.list');
Route::get('pelanggan/show/{id}', [PelangganController::class, 'show'])->name('pelanggan.show');
Route::get('pelanggan/add', [PelangganController::class, 'create'])->name('pelanggan.create');
Route::post('pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.add');
Route::post('pelanggan/send', [PelangganController::class, 'sendWhatsAppMessage'])->name('pelanggan.send');
Route::post('pelanggan/schedule', [PelangganController::class, 'sendWhatsAppMessageSchedule'])->name('pelanggan.send.schedule');
Route::get('pelanggan/edit/{id}', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::post('pelanggan/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::get('pelanggan/delete/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

// Route::get('layanan', [LayananController::class, 'index'])->name('layanan.list');
// Route::get('layanan/show/{id}', [LayananController::class, 'show'])->name('layanan.show');
// Route::get('layanan/add', [LayananController::class, 'create'])->name('layanan.create');
// Route::post('layanan/store', [LayananController::class, 'store'])->name('layanan.add');
// Route::get('layanan/edit/{id}', [LayananController::class, 'edit'])->name('layanan.edit');
// Route::post('layanan/update/{id}', [LayananController::class, 'update'])->name('layanan.update');
// Route::get('layanan/delete/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

Route::get('kos', [KosController::class, 'index'])->name('kos.list');
Route::get('kos/show/{id}', [KosController::class, 'show'])->name('kos.show');
Route::get('kos/add', [KosController::class, 'create'])->name('kos.create');
Route::post('kos/store', [KosController::class, 'store'])->name('kos.add');
Route::get('kos/edit/{id}', [KosController::class, 'edit'])->name('kos.edit');
Route::post('kos/update/{id}', [KosController::class, 'update'])->name('kos.update');
Route::get('kos/delete/{id}', [KosController::class, 'destroy'])->name('kos.destroy');

Route::get('category', [CategoryController::class, 'index'])->name('category.list');
Route::get('category/show/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('category/add', [CategoryController::class, 'create'])->name('category.create');
Route::post('category/store', [CategoryController::class, 'store'])->name('category.add');
Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('payment', [PaymentController::class, 'index'])->name('payment.list');
Route::get('payment/show/{id}', [PaymentController::class, 'show'])->name('payment.show');
Route::get('payment/add', [PaymentController::class, 'create'])->name('payment.create');
Route::post('payment/store', [PaymentController::class, 'store'])->name('payment.add');
Route::get('payment/edit/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
Route::post('payment/update/{id}', [PaymentController::class, 'update'])->name('payment.update');
Route::get('payment/delete/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');

Route::get('user', [UserController::class, 'index'])->name('user.list');
Route::get('user/show/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('user/add', [UserController::class, 'create'])->name('user.create');
Route::post('user/store', [UserController::class, 'store'])->name('user.add');
Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
