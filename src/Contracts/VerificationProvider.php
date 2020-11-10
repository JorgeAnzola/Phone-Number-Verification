<?php


namespace JorgeAnzola\PhoneNumberVerification\Contracts;


interface VerificationProvider
{
    public function sendVerificationToken(string $phoneNumber): bool;

    public function verifyToken(MustVerifyPhoneNumber $user, string $verificationToken): bool;

    public function markPhoneNumberAsVerified(MustVerifyPhoneNumber $user): bool;
}
