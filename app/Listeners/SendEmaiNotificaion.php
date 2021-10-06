<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use Illuminate\Support\Facades\Mail;

class SendEmaiNotificaion
{

    public function __construct()
    { }

    public function handle(SendEmailEvent $data)
    {
        $data = $data->getData();

        Mail::send($data['view'], ['details' => $data], function ($message) use ($data) {
            $message->to($data['emails']);
            $message->subject($data['title']);
        });
    }
}
