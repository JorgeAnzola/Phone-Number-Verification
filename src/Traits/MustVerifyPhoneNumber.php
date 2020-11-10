<?php

namespace JorgeAnzola\PhoneNumberVerification\Traits;

trait MustVerifyPhoneNumber
{

    public function __construct()
    {
    }

    /**
     * Determine if the user has verified their phone_number address.
     *
     * @return bool
     */
    public function hasVerifiedPhoneNumber()
    {
        $phoneNumberVerifiedAtColumn = config('phone_number_verification.phone_number_column', 'phone_number_verified_at');

        return !is_null($this->$phoneNumberVerifiedAtColumn);
    }

    /**
     * Mark the given user's phone number as verified.
     *
     * @return bool
     */
    public function markPhoneNumberAsVerified()
    {
        $phoneNumberVerifiedAtColumn = config('phone_number_verification.phone_number_column', 'phone_number_verified_at');

        return $this->forceFill([
            $phoneNumberVerifiedAtColumn => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the phone number verification code.
     *
     * @return void
     */
    public function sendPhoneNumberVerificationNotification(): void
    {
        $verificationProvider = config('phone_number_verification.verification_provider', '\JorgeAnzola\PhoneNumberVerification\Providers\TwilioVerificationProvider');

        (new $verificationProvider())->sendVerificationToken($this->getPhoneNumberForVerification());
    }

    /**
     * Get the phone number that should be used for verification.
     *
     * @return string
     */
    public function getPhoneNumberForVerification(): string
    {
        $phoneNumberColumn = config('phone_number_verification.phone_number_column', 'phone_number');

        return $this->$phoneNumberColumn;
    }
}
