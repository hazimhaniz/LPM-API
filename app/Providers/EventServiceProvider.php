<?php

namespace App\Providers;

use App\Events\SendEmailEvent;
use App\Listeners\SendEmaiNotificaion;
use App\Listeners\SendUmpkPmcNotification;
use App\Events\SendUmpkPmcEvent;
use App\Events\SendJpnSahLateEvent;
use App\Listeners\SendJpnSahLateNoti;
use App\Models\Kru\Kru;
use App\Models\User;
use App\Models\Permohonan\PermohonanCalon;
use App\Observers\KruObserver;
use App\Observers\UserObserver;
use App\Observers\PermohonanCalonObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SendEmailEvent::class =>[
            SendEmaiNotificaion::class,
        ],
        SendUmpkPmcEvent::class =>[
            SendUmpkPmcNotification::class,
        ],
        SendJpnSahLateEvent::class =>[
            SendJpnSahLateNoti::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Kru::observe(KruObserver::class);
        User::observe(UserObserver::class);
        //PermohonanCalon::observe(PermohonanCalonObserver::class);

    }
}
