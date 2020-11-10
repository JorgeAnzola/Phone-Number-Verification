<?php

use Illuminate\Support\Facades\Route;
use JorgeAnzola\PhoneNumberVerification\Http\Controllers\PhoneNumberVerificationPromptController;

Route::group(['middleware' => config('phone-number-verification.middleware', ['web', 'auth'])], function () {
    Route::get('/phone-number/verify', [PhoneNumberVerificationPromptController::class, '__invoke'])
        ->name('phone_number_verification.notice');

    Route::post('/phone-number/verify', [PhoneNumberVerificationPromptController::class, 'verify'])
            ->middleware(config('phone-number-verification.verify_token_middleware', ['throttle:10:1']))
            ->name('phone_number_verification.verify');

    Route::get('/phone-number/resend', [PhoneNumberVerificationPromptController::class, 'resend'])
            ->middleware(config('phone-number-verification.resend_token_middleware', ['throttle:5:1']))
            ->name('phone_number_verification.resend');
});
