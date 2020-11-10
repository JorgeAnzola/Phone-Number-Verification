# Phone Verification Number

Phone Number Verification is a package that allows the user to verify their mobile number as an extension to the dashboard functionality that Laravel and JetStream provides. 

## Installation

You can install the package via composer:

```sh
composer require jorgeanzola/phone-number-verification
```

After the package has been installed, run the migrations

```sh
php artisan migrate
```
 

## Usage

To enable the verification process in your User model (Or your "verificable" model) you must 
1. Implement a `MustVerifyPhoneNumber` interface
2. Use a `MustVerifyPhoneNumber` trait

for example

```php
...
use JorgeAnzola\PhoneNumberVerification\Traits\MustVerifyPhoneNumber;
use JorgeAnzola\PhoneNumberVerification\Contracts\MustVerifyPhoneNumber as IMustVerifyPhoneNumber;
...

class User implements IMustVerifyPhoneNumber
{
    ...
    use MustVerifyPhoneNumber;
    ...
```

If you are using the default VerificationProvider: Twilio will be used as the SMS service, therefore
you need to include the following environment variables

```env
TWILIO_AUTH_TOKEN=

TWILIO_SID=

TWILIO_VERIFY_SID=
```

## Verification provider

This is the class that will be used to send the verification code and to verify this token. By default, Twilio is used as a verification service.
If you wish to replace the default provider make sure to implement the VerificationProvider interface as you should provide

```php
public function sendVerificationToken(string $phoneNumber): bool;

public function verifyToken(MustVerifyPhoneNumber $user, string $verificationToken): bool;

public function markPhoneNumberAsVerified(MustVerifyPhoneNumber $user): bool;

```  


## Configuration

To publish the configuration file you can execute the command

```sh
php artisan vendor:publish --provider="JorgeAnzola\PhoneNumberVerification\Providers\ServiceProvider" --tag=config
```

Configurable parameters

```php
    'from' => env('APP_NAME'),

    'verification_provider' => '\JorgeAnzola\PhoneNumberVerification\Providers\TwilioVerificationProvider',

    'twilio_auth_token' => env('TWILIO_AUTH_TOKEN', null),

    'twilio_account_sid' => env('TWILIO_ACCOUNT_SID', null),

    'twilio_verify_sid' => env('TWILIO_VERIFY_SID', null),

    'views' => true,

    'verify_phone_number_view' => 'phone_number_verification::verify-phone-number',

    'middleware' => ['web', 'auth'],

    'verify_token_middleware' => ['throttle:10:1'],

    'resend_token_middleware' => ['throttle:5:1'],

    'users_table' => 'users',

    'phone_number_column' => 'phone_number',

    'phone_number_verified_at_column' => 'phone_number_verified_at',

```

A more extensive explanation of each parameter could be found on the published file itself. 

## API Usage

Loading... :)

## Views

To publish the view files you can execute the command

```sh
php artisan vendor:publish --provider="JorgeAnzola\PhoneNumberVerification\Providers\ServiceProvider" --tag=views
```

## Migrations

To publish the migration files you can execute the command.
If you're gonna change the migration, make sure the values on the configuration file match correctly.

```sh
php artisan vendor:publish --provider="JorgeAnzola\PhoneNumberVerification\Providers\ServiceProvider" --tag=migrations
```

## Translations

Loading... :)

To publish the view files you can execute the command

```sh
php artisan vendor:publish --provider="JorgeAnzola\PhoneNumberVerification\Providers\ServiceProvider" --tag=lang
```

### TODOs

 - Write tests
 - Release stable version
 - Assure compatibility with Laravel < v8
 - API usage

License
----

MIT

**Free Software, Hell Yeah!**
