<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendJpnSahLateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    private $peperiksaan;
    private $role;

    public function __construct($peperiksaan)
    { 
        $this->peperiksaan = $peperiksaan;
        //\Log::info("messagezzz_meme");
    }

    public function getRole()
    {  
        
    }

    public function getpeperiksaan()
    {  
        return $this->peperiksaan;
    }


}
