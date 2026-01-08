<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/destinasi', function () {
    return view('destinasi');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/posts', [PostController::class, 'index']);
