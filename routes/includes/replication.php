<?php

use App\Http\Controllers\ReplicationController;
use Illuminate\Support\Facades\Route;

    Route::group(['prefix' => 'replication', 'as' => 'replication.'], function () {
        Route::post('year', [ ReplicationController::class, 'year'])->name('year');
    });
?>