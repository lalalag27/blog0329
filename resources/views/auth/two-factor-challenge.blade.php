<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{ config('app.name', '鬼谷') }}
        </x-slot>

        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-zinc-600 dark:text-zinc-400" x-show="! recovery">
                {{ __('請通過輸入您的身份驗證器應用程序提供的身份驗證代碼來確認訪問您的帳號。') }}
            </div>

            <div class="mb-4 text-sm text-zinc-600 dark:text-zinc-400" x-cloak x-show="recovery">
                {{ __('請通過輸入您的緊急恢復代碼之一來確認訪問您的帳號。') }}
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-label for="code" value="{{ __('安全驗證碼') }}" />
                    <x-input id="code" class="block w-full mt-1" type="text" inputmode="numeric" name="code"
                        autofocus x-ref="code" autocomplete="one-time-code" />
                </div>

                <div class="mt-4" x-cloak x-show="recovery">
                    <x-label for="recovery_code" value="{{ __('恢復安全驗證碼') }}" />
                    <x-input id="recovery_code" class="block w-full mt-1" type="text" name="recovery_code"
                        x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button"
                        class="text-sm underline rounded-md text-zinc-600 dark:text-zinc-500 hover:text-gray-900 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400"
                        x-show="! recovery"
                        x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('使用恢復代碼') }}
                    </button>

                    <button type="button"
                        class="text-sm underline rounded-md text-zinc-600 dark:text-zinc-500 hover:text-gray-900 dark:hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400"
                        x-cloak x-show="recovery"
                        x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('使用驗證代碼') }}
                    </button>

                    <x-button class="ml-4">
                        {{ __('登入') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
