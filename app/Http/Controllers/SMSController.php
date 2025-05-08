<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    public function sendSMS($messageBody, $to)
{
    try {


        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.from');
        $twilio = new Client($sid, $token);

        $message = $twilio->messages->create($to, [
            'body' => $messageBody,
            'from' => $from,
        ]);

        return $message; // Return the message object
    } catch (\Exception $e) {
        // You can log the error if needed
        return false; // Return false on failure
    }
}
}
