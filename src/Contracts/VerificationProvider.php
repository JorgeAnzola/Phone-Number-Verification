<?php


namespace JorgeAnzola\PhoneNumberVerification\Contracts;


interface VerificationProvider
{
    public function sendVerificationToken(String $phoneNumber);

    public function verifyToken(MustVerifyPhoneNumber $user, string $verificationToken);
}
