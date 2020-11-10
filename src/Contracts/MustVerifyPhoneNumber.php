<?php

namespace JorgeAnzola\PhoneNumberVerification\Contracts;

interface MustVerifyPhoneNumber
{
    /**
     * Determine if the user has verified their phone number.
     *
     * @return bool
     */
    public function hasVerifiedPhoneNumber();

    /**
     * Mark the given user's phone number as verified.
     *
     * @return bool
     */
    public function markPhoneNumberAsVerified();

    /**
     * Send the phone number verification notification.
     *
     * @return void
     */
    public function sendPhoneNumberVerificationNotification();

    /**
     * Get the phone number that should be used for verification.
     *
     * @return string
     */
    public function getPhoneNumberForVerification();
}
