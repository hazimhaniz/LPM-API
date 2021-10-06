<?php

use App\Http\Controllers\Datatable\JadualWaktuPeperiksaanController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'json', 'as' => 'json.', 'middleware' => 'auth'], function () {
    Route::get('matapelajaran', [ JadualWaktuPeperiksaanController::class, 'getListMatapelajaran'])->name('matapelajran');
});
