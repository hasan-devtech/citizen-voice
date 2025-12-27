<?php

use Illuminate\Support\Facades\Route;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

Route::get('/', function () {
    // return $response = Http::withHeaders([
    //     'Authorization' => config('services.sms.token'),
    //     'Accept' => 'application/json',
    // ])->post(config('services.sms.gateway_url'), [
    //             'to' => "+963959871726",
    //             'message' => "hey",
    //         ]);
});
