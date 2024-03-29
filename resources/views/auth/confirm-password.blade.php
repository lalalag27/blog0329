<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{ config('app.name', '鬼谷') }}
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('為了驗證帳戶的安全，請在繼續之前確認您的密碼') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('密碼') }}" />
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                    autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('確認') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
