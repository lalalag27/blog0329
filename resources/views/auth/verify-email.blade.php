<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{ config('app.name', '鬼谷') }}
        </x-slot>

        <div class="mb-4 text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('在繼續之前，您可以通過點擊我們剛剛發送給您的連結來驗證您的電子信箱帳號，如果您沒有收到電子郵件，我們很樂意再次發送。') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ __('一封新的驗證連結已發送到您在個人資料註冊中提供的電子信箱帳號。') }}
            </div>
        @endif

        <div class="flex items-center justify-between mt-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button type="submit">
                        {{ __('重發驗證信件') }}
                    </x-button>
                </div>
            </form>

            <div>
                <a href="{{ route('profile.show') }}"
                    class="text-sm text-gray-600 underline rounded-md dark:text-zinc-500 hover:text-gray-900 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400">
                    {{ __('編輯個人資料') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit"
                        class="ml-2 text-sm text-gray-600 underline rounded-md dark:text-zinc-500 hover:text-gray-900 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400">
                        {{ __('登出') }}
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
