<?php

use App\Http\Controllers\Api\AgencyController;
use App\Http\Controllers\Api\AttachmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ComplaintCategoryController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\FcmController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\OtpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Authentication 
Route::post('auth/verify-otp', [OtpController::class, 'verifyOtp']);
Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login')->middleware('throttle:login_secure');
    Route::delete('logout', 'logout')->middleware('auth:sanctum');
    Route::post('forget-password', 'forgetPassword');
    Route::post('reset-password', 'resetPassword');
    Route::post('resend-otp', 'resendOtp');
});


//
Route::middleware(['auth:sanctum', 'set.language'])->group(function () {
    Route::get('agencies', [AgencyController::class, 'index']);
    Route::get('locations', [LocationController::class, 'index']);
    Route::get('complaint-categories', [ComplaintCategoryController::class, 'index']);
});

//
Route::controller(ComplaintController::class)->middleware(['auth:sanctum', 'set.language'])->prefix('complaints')->group(function () {
    Route::post('', 'store');
    Route::get('', 'index');
});
Route::get('attachments/{attachment}', [AttachmentController::class, 'show'])
    ->middleware('auth:sanctum')
    ->name('attachments.show');




Route::post('fcm-set', [FcmController::class, 'setToken'])->middleware('auth:sanctum');
