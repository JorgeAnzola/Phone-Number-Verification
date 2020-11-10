<?php

namespace JorgeAnzola\PhoneNumberVerification\Providers;

use Twilio\Rest\Client;
use JorgeAnzola\PhoneNumberVerification\Contracts\MustVerifyPhoneNumber;
use \JorgeAnzola\PhoneNumberVerification\Contracts\VerificationProvider as IVerificationProvider;

class TwilioVerificationProvider implements IVerificationProvider
{
    protected $verifyService = null;

    public function __construct()
    {
        $this->verifyService = $this->verifyService();
    }

    public function sendVerificationToken(string $phoneNumber): bool
    {
        $this->verifyService->verifications->create($phoneNumber, "sms");

        return true;
    }

    public function verifyToken(MustVerifyPhoneNumber $user, string $verificationToken): bool
    {
        $verification = $this->verifyService->verificationChecks->create($verificationToken, ['from' => config('phone_number_verification.from'), 'to' => $user->getPhoneNumberForVerification()]);

        return $verification->valid;
    }

    public function markPhoneNumberAsVerified(MustVerifyPhoneNumber $user): bool
    {
        return $user->markPhoneNumberAsVerified();
    }

    protected function verifyService()
    {
        $token = config('phone_number_verification.twilio_auth_token');
        $twilioAccontSid = config('phone_number_verification.twilio_account_sid');
        $twilioVerifySid = config('phone_number_verification.twilio_verify_sid');

        return (new Client($twilioAccontSid, $token))->verify->v2->services($twilioVerifySid);
    }
}
