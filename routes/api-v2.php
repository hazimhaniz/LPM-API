<?php

use App\Http\Controllers\Api\PusatPeperiksaanController;
use App\Http\Controllers\Api\SelenggaraDataController;
use App\Http\Controllers\Api\PengumpulanDanCantumanMarkahController;
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

Route::prefix( '{peperiksaan}' )->group( function () {

    /*
    ---- Authentication ----
    */

    Route::prefix( 'keselamatan' )->group(function (){});



    /*
    ----  PUSAT ----
    */

    Route::prefix( 'pusat-peperiksaan' )->middleware( 'auth:sanctum' )->group(function ()
    {
        Route::prefix('/update')->group(function () {
            Route::post('/status', [PusatPeperiksaanController::class, 'updateStatus']);
        });
    });


    /*
    ---- CALON ----
    */

    Route::prefix( 'calon' )->middleware( 'auth:sanctum' )->group( function (){});

     /*
    ---- STATIC DATA ----
    */

    Route::prefix( 'constant' )->group(function (){
        Route::get('/negara', [SelenggaraDataController::class, 'negara']);
    });

    /* 
    ---- PENGUMPULAN DAN CANTUMAN MARKAH ----
    */
    Route::prefix( 'pengumpulan-dan-cantuman-markah' )->group(function (){
        Route::get('/gred', [PengumpulanDanCantumanMarkahController::class, 'index']);
    });

    // Get Mata pelajaran
    Route::prefix( 'pengumpulan-dan-cantuman-markah' )->group(function (){
        Route::get('/matapelajaran', [PengumpulanDanCantumanMarkahController::class, 'mataPelajaran']);
    });
});
