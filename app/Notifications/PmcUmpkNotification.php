<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PmcUmpkNotification extends Notification
{
    use Queueable;

    private $calon;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($calonPmc)
    {
        $this->calon = $calonPmc;

    }

    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {     
        return [
            'nama' => $this->calon['nama'],
            'angka_giliran' => $this->calon['angka_giliran'],
            'name_' => 'Permohonan pembetulan maklumat calon'
        ];
    }
}
