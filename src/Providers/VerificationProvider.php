<?php

namespace JorgeAnzola\PhoneNumberVerification\Providers;

use Twilio\Rest\Client;
use Illuminate\Http\JsonResponse;
use JorgeAnzola\PhoneNumberVerification\Contracts\MustVerifyPhoneNumber;
use \JorgeAnzola\PhoneNumberVerification\Contracts\VerificationProvider as IVerificationProvider;

class VerificationProvider implements IVerificationProvider
{
    protected $verifyService = null;

    protected $from = '';

    public function __construct()
    {
        $this->verifyService = $this->verifyService();

        $this->from = config('phone-number-verification.from');
    }

    public function sendVerificationToken(string $phoneNumber): void
    {
        $this->verifyService->verifications->create($phoneNumber, "sms");
    }

    public function verifyToken(MustVerifyPhoneNumber $user, string $verificationToken): void
    {
        $verification = $this->verifyService->verificationChecks->create($verificationToken, ['from' => $this->from, 'to' => $user->getPhoneNumberForVerification()]);

        if ($verification->valid) {
            $user->markPhoneNumberAsVerified();
        }
    }

    protected function verifyService()
    {
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilioSid = getenv("TWILIO_SID");
        $twilioVerifySid = getenv("TWILIO_VERIFY_SID");

        return (new Client($twilioSid, $token))->verify->v2->services($twilioVerifySid);
    }
}
