<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Jobs\IsJpnSahLate;
use App\Models\Permohonan\PermohonanCalon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('PusatModule', function($app) {
            return new \App\Modules\Pusat\Main;
        });

        $this->app->bind('PembayaranModule', function($app) {
            return new \App\Modules\Pembayaran\Main;
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('layouts.pagination');
    }
}
