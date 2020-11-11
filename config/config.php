<?php

return [


    /*
    |--------------------------------------------------------------------------
    | Default FROM Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of the sender of the verification token. Will
    | be shown in the SMS the user receives. it defaults to the app name
    | defined in the env file
    |
    */

    'from' => env('APP_NAME'),
    
    // TODO
    /*
    |--------------------------------------------------------------------------
    | Force verification for users with no number
    |--------------------------------------------------------------------------
    |
    | Determines if the verification middleware should run even if the user
    | has no phone number in the database. Set it to true if asking for
    | the phone number is part of your registration process.
    |
    */

    'force_verification_for_empty_numbers' => false,

    /*
    |--------------------------------------------------------------------------
    | Verification provider
    |--------------------------------------------------------------------------
    |
    | Determines the class that will be used to send the verification token and mark
    | the phone number as verified in the user's record. You can replace it with
    | a custom one. Make sure to implement VerificationProvider contract.
    |
    */

    'verification_provider' => '\JorgeAnzola\PhoneNumberVerification\Providers\TwilioVerificationProvider',

    /*
    |--------------------------------------------------------------------------
    | Twilio auth token
    |--------------------------------------------------------------------------
    |
    | The Twilio account auth token is specific for the included
    | TwilioVerificationProvider, if you are using a custom
    | provider you can dismiss this variable.
    |
    | For more information please refer to
    | https://www.twilio.com/docs/salesforce/install#obtain-your-twilio-account-sid-and-auth-token
    |
    */

    'twilio_auth_token' => env('TWILIO_AUTH_TOKEN', null),

    /*
    |--------------------------------------------------------------------------
    | Twilio SID
    |--------------------------------------------------------------------------
    |
    | The Twilio SID is specific for the included TwilioVerificationProvider
    | if you are using a custom provider
    | you can dismiss this variable.
    |
    | For more information please refer to
    | https://www.twilio.com/docs/salesforce/install#obtain-your-twilio-account-sid-and-auth-token
    |
    */

    'twilio_account_sid' => env('TWILIO_ACCOUNT_SID', null),

    /*
    |--------------------------------------------------------------------------
    | Twilio verify SID
    |--------------------------------------------------------------------------
    |
    | The Twilio verify SID is specific for the included TwilioVerificationProvider
    | if you are using a custom provider
    | you can dismiss this variable.
    |
    | For more information please refer to
    | https://www.twilio.com/docs/verify/api/service
    |
    */

    'twilio_verify_sid' => env('TWILIO_VERIFY_SID', null),

    /*
    |--------------------------------------------------------------------------
    | Enables the views
    |--------------------------------------------------------------------------
    |
    | This value determines whether the implementation of the views is
    | enabled or not. The view is used to prompt the user for
    | their phone number and to provide a resend button
    |
    */

    'views' => true,

    /*
    |--------------------------------------------------------------------------
    | Verify phone number view
    |--------------------------------------------------------------------------
    |
    | Determines the view that will be used to prompt the user for their phone
    | number for verification. If you're going to replace it specify the
    | namespace of the views and the name of the file
    |
    */

    'verify_phone_number_view' => 'phone_number_verification::verify-phone-number',

    /*
    |--------------------------------------------------------------------------
    | Global middleware
    |--------------------------------------------------------------------------
    |
    | This value defines the global middleware that will be applied
    | to the phone number verification routes. You probably won't
    | need to change this unless very specific use case.
    |
    */

    'middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Verify token route middleware
    |--------------------------------------------------------------------------
    |
    | This value determines the set of middleware that will be applied
    | specifically and only to the verify token route.
    | Throttling is highly advised.
    |
    */

    'verify_token_middleware' => ['throttle:10:1'],

    /*
    |--------------------------------------------------------------------------
    | Resend token route middleware
    |--------------------------------------------------------------------------
    |
    | This value determines the set of middleware that will be applied
    | specifically and only to the resend token route.
    | Throttling is highly advised.
    |
    */

    'resend_token_middleware' => ['throttle:5:1'],

    /*
    |--------------------------------------------------------------------------
    | Users table
    |--------------------------------------------------------------------------
    |
    | This value determines which table will be used
    | to store the user's phone number.
    | Probably users is just fine.
    |
    | BE CAREFUL, changing this will require to refresh the migrations
    | which might cause data loss.
    |
    */

    'users_table' => 'users',

    /*
    |--------------------------------------------------------------------------
    | Phone number column
    |--------------------------------------------------------------------------
    |
    | This value determines which column on the table {users_table} will be
    | be used to store the user's phone number.
    | Probably users is just fine.
    |
    | BE CAREFUL, changing this will require to refresh the migrations
    | which might cause data loss.
    |
    */

    'phone_number_column' => 'phone_number',

    /*
    |--------------------------------------------------------------------------
    | Phone number column
    |--------------------------------------------------------------------------
    |
    | This value determines which column on the table {users_table} will be
    | be used to mark the user's phone number as verified.
    | Probably phone_number_verified_at is just fine.
    |
    | BE CAREFUL, changing this will require to refresh the migrations
    | which might cause data loss.
    |
    */

    'phone_number_verified_at_column' => 'phone_number_verified_at',
];
