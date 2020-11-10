<?php

namespace JorgeAnzola\PhoneNumberVerification\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use JorgeAnzola\PhoneNumberVerification\Http\Requests\PhoneNumberVerification;

class PhoneNumberVerificationPromptController
{
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedPhoneNumber() ? redirect()->intended(config('phone-number-verification.home',
            'dashboard')) : view(config('phone-number-verification.verify-phone-number-view', 'phone-number-verification::verify-phone-number'));
    }

    public function verify(PhoneNumberVerification $request)
    {
        $verificationProvider = config('phone-number-verification.verification_provider', '\JorgeAnzola\PhoneNumberVerification\Providers\VerificationProvider');

        (new $verificationProvider())->verifyToken($request->user(), $request->verification_token);

        return $request->wantsJson() ? new JsonResponse([]) : back()->with('verification_token_sent', true);
    }

    public function resend(Request $request)
    {
        $request->user()->sendPhoneNumberVerificationNotification();

        return $request->wantsJson() ? new JsonResponse([]) : back()->with('verification_token_resent', true);
    }
}
