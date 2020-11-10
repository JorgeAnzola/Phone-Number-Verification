<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo/>
        </x-slot>

        <x-jet-validation-errors class="mb-4"/>

        <form method="POST" action="{{ route('phone_number_verification.verify') }}">
            @csrf

            <div>
                <x-jet-label for="verification_token" value="{{ __('Verification token') }}"/>
                <x-jet-input id="verification_token" class="block mt-1 w-full" type="text" name="verification_token" :value="old('verification_token')" required autofocus autocomplete="verification_token"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('phone_number_verification.resend') }}">
                    {{ __('Resend token?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Submit') }}
                </x-jet-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                {{ __('Logout') }}
            </button>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
