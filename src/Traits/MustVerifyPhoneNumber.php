<?php

namespace JorgeAnzola\PhoneNumberVerification\Traits;

trait MustVerifyPhoneNumber
{

    /**
     * Determine if the user has verified their phone_number address.
     *
     * @return bool
     */
    public function hasVerifiedPhoneNumber()
    {
        return !is_null($this->phone_number_verified_at);
    }

    /**
     * Mark the given user's phone number as verified.
     *
     * @return bool
     */
    public function markPhoneNumberAsVerified()
    {
        return $this->forceFill([
            'phone_number_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the phone number verification code.
     *
     * @return void
     */
    public function sendPhoneNumberVerificationNotification(): void
    {
        $verificationProvider = config('phone-number-verification.verification_provider', '\JorgeAnzola\PhoneNumberVerification\Providers\VerificationProvider');

        (new $verificationProvider())->sendVerificationToken($this->getPhoneNumberForVerification());
    }

    /**
     * Get the phone number that should be used for verification.
     *
     * @return string
     */
    public function getPhoneNumberForVerification(): string
    {
        return $this->phone_number;
    }
}
