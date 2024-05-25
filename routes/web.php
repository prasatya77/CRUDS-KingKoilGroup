<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/soal-1', function () {
    return view('soal-1');
});

Route::get('/soal-2', function () {
    return view('soal-2');
});

Route::get('/soal-3', function () {
    return view('soal-3');
});
