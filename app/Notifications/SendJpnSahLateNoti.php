<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendJpnSahLateNoti extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $calon;

    public function __construct($calon)
    {
        $this->calon = $calon;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {   //\Log::info($this->calon->toarray());
        return [
            'nama' => $this->calon->toarray()[0]['calon']['nama'],
            'angka_giliran' => $this->calon->toarray()[0]['calon']['angka_giliran'],
            'titile' => 'Sudah 7 hari JPN tidak mengesahkan permohonan pendaftaran calon '
        ];
    }
}
