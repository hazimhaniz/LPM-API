<?php

namespace App\Providers;

use App\Providers\SendJpnSahLateEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendJpnSahLateNoti
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendJpnSahLateEvent  $event
     * @return void
     */
    public function handle(SendJpnSahLateEvent $event)
    {
        //
    }
}
