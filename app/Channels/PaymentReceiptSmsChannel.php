<?php

namespace App\Channels;

use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;

class PaymentReceiptSmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        return 'Done!';
        // $receptor = $notifiable->phone_number;
        $receptor = '09221683887';
        $type = 1;
        $template = "HSPayment";
        $param1 = $notification->orderId;
        $param2 = $notification->amount;
        $param3 = $notification->refId;

        $api = new GhasedakApi(env('GHASEDAKAPI_API_KEY'));
        $api->Verify($receptor, $type, $template, $param1, $param2, $param3);
        return 'Done!';

    }
}
