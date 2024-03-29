<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{ config('app.name', '鬼谷') }}
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('名稱') }}" />
                <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('信箱') }}" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('密碼') }}" />
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('密碼確認') }}" />
                <x-input id="password_confirmation" class="block w-full mt-1" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('我同意 :terms_of_service 與 :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="text-sm text-gray-600 underline rounded-md dark:text-zinc-500 hover:text-gray-900 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400">' .
                                        __('服務條款') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="text-sm text-gray-600 underline rounded-md dark:text-zinc-500 hover:text-gray-900 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400">' .
                                        __('隱私權政策') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-gray-600 underline rounded-md dark:text-zinc-500 hover:text-gray-900 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400"
                    href="{{ route('login') }}">
                    {{ __('已經註冊過了嗎?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('註冊') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
