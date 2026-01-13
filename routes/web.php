<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // <--- Jangan lupa tambahkan ini di paling atas

Route::get('/', function () {
    return view('welcome');
});
Route::get('/destinasi', function () {
    return view('destinasi');
});
Route::get('/about', function () {
    return view('about');
});

use App\Http\Controllers\PariwisataController;

Route::get('/', [PariwisataController::class, 'index']);
Route::post('/destinasi/store', [PariwisataController::class, 'store'])->name('destinasi.store');
Route::get('/kategori/{id}', [PariwisataController::class, 'categoryShow'])->name('category.show');

// Route untuk halaman utama admin
Route::get('/admin/dashboard', [PariwisataController::class, 'adminIndex'])->name('admin.index');

// Route Delete
Route::delete('/admin/destinasi/{id}', [PariwisataController::class, 'destroy'])->name('admin.destroy');

// Route Edit & Update (seperti yang dibahas sebelumnya)
Route::get('/admin/destinasi/edit/{id}', [PariwisataController::class, 'edit'])->name('admin.edit');
Route::put('/admin/destinasi/update/{id}', [PariwisataController::class, 'update'])->name('admin.update');

Route::get('/destinasi', [PariwisataController::class, 'allDestinations'])->name('destinasi.index');

// Pastikan parameter {id} ada di sini
Route::get('/destinasi/{id}', [PariwisataController::class, 'show'])->name('destinasi.show');



// --- ROUTE LOGIN & LOGOUT ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- GROUP ROUTE KHUSUS ADMIN (DIPROTEKSI PASSWORD) ---
Route::middleware(['auth'])->group(function () {
    
    // Semua Route Admin Masukkan Di Sini:
    Route::get('/admin/dashboard', [PariwisataController::class, 'adminIndex'])->name('admin.index');
    Route::post('/destinasi/store', [PariwisataController::class, 'store'])->name('destinasi.store');
    Route::delete('/admin/destinasi/{id}', [PariwisataController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/destinasi/edit/{id}', [PariwisataController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/destinasi/update/{id}', [PariwisataController::class, 'update'])->name('admin.update');

});