<?php

use App\Http\Controllers\Api\V1\BarangController;
use App\Http\Controllers\Api\V1\LockerController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'barang'], function () {
    Route::post('/create', [BarangController::class, 'create']);
    Route::post('/read', [BarangController::class, 'read']);
    Route::post('/update', [BarangController::class, 'update']);
    Route::post('/softDelete', [BarangController::class, 'softDelete']);
    Route::post('/search', [BarangController::class, 'search']);
});

