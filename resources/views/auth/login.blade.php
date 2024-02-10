<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
            <h2 style='text-align:center'>{{ config("app.name")}}</h2>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-4">
            <span style="font-family: 'Courier New', Courier, monospace; font-size: 24px;">Faça Login em LogiGate</span>
        </div>
        <hr>
        <div class="mt-4">
            <p>Logigate ID is a new personal profile for builders <a href="#">Ver mais</a></p>
        </div>
        <div class="mt-3">
            <p> <i class="fas fa-check"></i> Get started for free</p>
        </div>
        <div class="mt-3">
            <p> <i class="fas fa-check"></i>Complement your existing Logigate accounts </p>
        </div>
        <div class="mt-3">
            <p> <i class="fas fa-check"></i>Secure your login with optional 2FA </p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Lembra-me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Esqueci Palavra-passe?') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Acessar') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
