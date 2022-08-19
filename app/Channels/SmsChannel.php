<?php

namespace App\Channels;

use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        return 'Done!';
        // $receptor = $notifiable->phone_number;
        $receptor = '09221683887';
        $type = 1;
        $template = "HamrahSoftware";
        $param1 = $notification->code;

        $api = new GhasedakApi(env('GHASEDAKAPI_API_KEY'));
        $api->Verify($receptor, $type, $template, $param1);
        return 'Done!';

    }
}
