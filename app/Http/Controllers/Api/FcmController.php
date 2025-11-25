<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\FcmToken;
use Illuminate\Http\Request;


class FcmController extends Controller
{
    public function setToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string|max:255',
        ]);
        FcmToken::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'user_type' => get_class($request->user()),
                'token' => $request->fcm_token,
            ],
            []
        );
        return ResponseHelper::success(null, "FCM Token set successfully", 201);
    }
}
