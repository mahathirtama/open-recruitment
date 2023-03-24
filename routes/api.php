<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\PencakerController;
use App\Http\Controllers\PencakerDaftarLowonganController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PengalamanController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PerusahaanDaftarEventController;
use App\Http\Controllers\ProvinsiController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
Route::group([

    'middleware' => 'IsPencaker',
    'prefix' => 'pencaker'

], function () {

    Route::resource('/lowongan',  LowonganController::class);
    Route::resource('/pendidikan',  PendidikanController::class);
    Route::resource('/pencaker',  PencakerController::class);
    Route::resource('/pengalaman',  PengalamanController::class);

    Route::resource('/artikel',  ArtikelController::class);
    Route::resource('/daftar-lowongan',  PencakerDaftarLowonganController::class);
});
Route::group([

    'middleware' => 'IsPerusahaan',
    'prefix' => 'perusahaan'

], function () {

    Route::resource('/perusahaan',  PerusahaanController::class);
    Route::resource('/event',  EventController::class);

    Route::resource('/daftar-event',  PerusahaanDaftarEventController::class);
});
Route::group([

    'middleware' => 'auth:api',
    'prefix' => 'master-data'

], function () {
    Route::resource('/bidang',  BidangController::class);
    Route::resource('/provinsi',  ProvinsiController::class);
});
