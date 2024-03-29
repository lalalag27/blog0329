<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{ config('app.name', '鬼谷') }}
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('登入信箱') }}" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('密碼') }}" />
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ __('記住我') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm underline rounded-md text-zinc-600 dark:text-zinc-500 hover:text-gray-900 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400"
                        href="{{ route('password.request') }}">
                        {{ __('忘記密碼?') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('登入') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
