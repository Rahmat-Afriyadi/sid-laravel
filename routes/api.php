<?php

use App\Http\Controllers\DesaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\PendudukController;
use App\Http\Middleware\JwtMiddleware;

Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('user', [JWTAuthController::class, 'getUser']);
    Route::post('logout', [JWTAuthController::class, 'logout']);
});

Route::prefix('desa')->middleware([JwtMiddleware::class])->group(function () {
    Route::get('show', [DesaController::class, 'show']);
});

Route::prefix('penduduk')->middleware([JwtMiddleware::class])->group(function () {
    Route::get('grafik/agama', [PendudukController::class, 'grafikByAgama']);
    Route::get('grafik/gender', [PendudukController::class, 'grafikByGender']);
    Route::get('grafik/usia', [PendudukController::class, 'grafikByUsia']);
    Route::get('grafik/pendidikan', [PendudukController::class, 'grafikByPendidikan']);
    Route::get('grafik/pekerjaan', [PendudukController::class, 'grafikByPekerjaan']);
});