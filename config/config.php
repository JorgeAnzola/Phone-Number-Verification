<?php

return [
    'middleware' => ['web'],
    'from' => env('APP_NAME'),
    'verification_provider' => '\JorgeAnzola\PhoneNumberVerification\Providers\VerificationProvider',

    // todo
    'views' => true,
    'verify_token_middleware' => [],
    'resend_token_middleware' => [],
];
