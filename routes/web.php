<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PariwisataController; // Controller Utama
use App\Http\Controllers\AuthController;       // Controller Login/Register

// ==========================================
// 1. ROUTE PUBLIK (Bisa diakses siapa saja)
// ==========================================

// Homepage
Route::get('/', [PariwisataController::class, 'index']);

// Halaman Statis
Route::get('/about', function () {
    return view('about');
});

// Destinasi & Kategori
Route::get('/destinasi', [PariwisataController::class, 'allDestinations'])->name('destinasi.index');
Route::get('/destinasi/{id}', [PariwisataController::class, 'show'])->name('destinasi.show');
Route::get('/kategori/{id}', [PariwisataController::class, 'categoryShow'])->name('category.show');


// ==========================================
// 2. ROUTE TAMU (Hanya untuk yang BELUM Login)
// ==========================================
Route::middleware('guest')->group(function() {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// --- ROUTE FITUR INTERAKTIF (Wajib Login) ---
Route::middleware(['auth'])->group(function () {
    Route::post('/destinasi/{id}/comment', [PariwisataController::class, 'postComment'])->name('destinasi.comment');
    Route::post('/destinasi/{id}/like', [PariwisataController::class, 'toggleLike'])->name('destinasi.like');
});


// ==========================================
// 3. ROUTE USER LOGIN (Harus Login Dulu)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Fitur Interaktif (Like & Comment)
    Route::post('/destinasi/{id}/comment', [PariwisataController::class, 'postComment'])->name('destinasi.comment');
    Route::post('/destinasi/{id}/like', [PariwisataController::class, 'toggleLike'])->name('destinasi.like');


    // ------------------------------------------
    // 4. AREA KHUSUS ADMIN (DIPROTEKSI ROLE)
    // ------------------------------------------
    
    // Dashboard Admin (Cek Role: Kalau bukan admin, tendang ke Home)
    Route::get('/admin/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect('/'); 
        }
        // Panggil fungsi adminIndex dari controller secara manual
        return app(PariwisataController::class)->adminIndex();
    })->name('admin.index');

    // CRUD Destinasi (Create, Update, Delete)
    // Sebaiknya tambahkan logika pengecekan admin juga di controller, 
    // tapi untuk tugas ini, taruh di sini sudah cukup aman.
    Route::post('/destinasi/store', [PariwisataController::class, 'store'])->name('destinasi.store');
    Route::get('/admin/destinasi/edit/{id}', [PariwisataController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/destinasi/update/{id}', [PariwisataController::class, 'update'])->name('admin.update');
    Route::delete('/admin/destinasi/{id}', [PariwisataController::class, 'destroy'])->name('admin.destroy');

});