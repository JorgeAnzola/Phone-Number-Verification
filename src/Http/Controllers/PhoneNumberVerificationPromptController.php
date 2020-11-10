<?php

namespace JorgeAnzola\PhoneNumberVerification\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use JorgeAnzola\PhoneNumberVerification\Http\Requests\PhoneNumberVerification;

class PhoneNumberVerificationPromptController
{
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedPhoneNumber() ? redirect()->intended(config('phone_number_verification.home',
            'dashboard')) : view(config('phone_number_verification.verify_phone_number_view', 'phone_number_verification::verify-phone-number'));
    }

    public function verify(PhoneNumberVerification $request)
    {
        $verificationProvider = config('phone_number_verification.verification_provider', '\JorgeAnzola\PhoneNumberVerification\Providers\TwilioVerificationProvider');

        $verificationProviderInstance = (new $verificationProvider());

        $verificationResult = $verificationProviderInstance->verifyToken($request->user(), $request->verification_token);

        if ($verificationResult) {

            $verificationProviderInstance->markPhoneNumberAsVerified($request->user());

            return $request->wantsJson() ? new JsonResponse([]) : back()->with('verification_token_sent', true);
        }
    }

    public function resend(Request $request)
    {
        $request->user()->sendPhoneNumberVerificationNotification();

        return $request->wantsJson() ? new JsonResponse([]) : back()->with('verification_token_resent', true);
    }
}
