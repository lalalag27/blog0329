<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{ config('app.name', '鬼谷') }}
        </x-slot>

        <div class="mb-4 text-sm text-zinc-600 dark:text-zinc-300">
            {{ __('忘記了您的密碼？沒問題。告訴我們您的註冊電子信箱，我們將向您發送一個密碼重置鏈接，讓您設定一個新的密碼。') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('註冊信箱') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('發送密碼重置信件') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
