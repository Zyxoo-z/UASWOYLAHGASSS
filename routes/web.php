<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/destinasi', function () {
    return view('destinasi');
});
Route::get('/about', function () {
    return view('about');
});

