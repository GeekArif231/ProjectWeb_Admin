<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PenyewaanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingPage');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/admin/login', [AdminController::class,'login'])->name('admin.login.submit');
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Route::get('/admin/penyewaan', [PenyewaanController::class, 'index'])->name('admin.penyewaan.index');
});
Route::get('/gedung', [GedungController::class, 'index'])->name('gedung.index');
Route::get('/gedung/{id}', [GedungController::class, 'show'])->name('gedung.show');

Route::get('/gedung/{id}/edit', [GedungController::class, 'edit'])->name('gedungs.edit');
Route::put('/gedung/{id}', [GedungController::class, 'update'])->name('gedungs.update');
Route::post('/gedung/delete', [GedungController::class, 'destroy'])->name('gedung.delete');

// Route::get('/gedung/created', [GedungController::class, '#'])->name('gedungs.buat');
Route::get('/gedungs/created', [GedungController::class, 'create'])->name('gedungs.create');
// Route::get('/test', [GedungController::class, 'create']);

Route::get('/penyewaan/pending', [PenyewaanController::class, 'pending'])->name('penyewaan.pending');
Route::post('/penyewaan/update-status', [PenyewaanController::class, 'updateStatus'])->name('penyewaan.updateStatus');

Route::get('/riwayat-penyewaan', [RiwayatController::class, 'index'])->name('riwayat.index');

Route::post('/gedung', [GedungController::class, 'store'])->name('gedungs.store');

require __DIR__ . '/auth.php';
