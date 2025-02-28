<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\GeografiController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\KategoriArticleController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PendidikanController;
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
    Route::put('update/{penduduk}', [PendudukController::class, 'update']);
    Route::post('store', [PendudukController::class, 'store']);
    Route::get('grafik/agama', [PendudukController::class, 'grafikByAgama']);
    Route::get('grafik/agama', [PendudukController::class, 'grafikByAgama']);
    Route::get('grafik/gender', [PendudukController::class, 'grafikByGender']);
    Route::get('grafik/usia', [PendudukController::class, 'grafikByUsia']);
    Route::get('grafik/pendidikan', [PendudukController::class, 'grafikByPendidikan']);
    Route::get('grafik/pekerjaan', [PendudukController::class, 'grafikByPekerjaan']);
});

Route::prefix('pekerjaan')->middleware([JwtMiddleware::class])->group(function () {
    Route::put('update/{pekerjaan}', [PekerjaanController::class, 'update']);
    Route::post('store', [PekerjaanController::class, 'store']);
});
Route::prefix('pendidikan')->middleware([JwtMiddleware::class])->group(function () {
    Route::put('update/{pendidikan}', [PendidikanController::class, 'update']);
    Route::post('store', [PendidikanController::class, 'store']);
});
Route::prefix('geografis')->middleware([JwtMiddleware::class])->group(function () {
    Route::put('update/{geografis}', [GeografiController::class, 'update']);
    Route::post('store', [GeografiController::class, 'store']);
});
Route::prefix('article')->middleware([JwtMiddleware::class])->group(function () {
    Route::put('update/{article}', [ArticleController::class, 'update']);
    Route::post('store', [ArticleController::class, 'store']);
});
Route::prefix('kategori-article')->middleware([JwtMiddleware::class])->group(function () {
    Route::put('update/{kategori_article}', [KategoriArticleController::class, 'update']);
    Route::post('store', [KategoriArticleController::class, 'store']);
});