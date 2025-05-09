<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    public function sendSMS($messageBody, $to)
{
    try {


        $sid = "AC1b7a4edd70d1a740916709833a288433";
        $token = "6882affe2eabc7589e42939f43bf8133";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages->create($to, [
            'body' => $messageBody,
            'from' => "+15673623604",
        ]);

        return $message; // Return the message object
    } catch (\Exception $e) {
        // You can log the error if needed
        return false; // Return false on failure
    }
}
}
