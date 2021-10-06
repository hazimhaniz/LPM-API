<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PmcUmpkNotification;
use App\Events\SendUmpkPmcEvent;


class SendUmpkPmcNotification implements ShouldQueue
{
    public $connection = 'database';
    public $queue = 'default';
    private $user;
   

    public function __construct(User $user)
    {
      $this->user = $user;
    }

    public function handle(SendUmpkPmcEvent $calon)
    {  
        $umpk = $this->user->role('umpk')
        ->where('id_peperiksaan', $calon->getpeperiksaan())
        ->get();

        $calonPmc = $calon->getCalon();
        
        Notification::send($umpk, new PmcUmpkNotification($calonPmc));
    }
}
