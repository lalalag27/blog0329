<x-action-section>
    <x-slot name="title">
        {{ __('雙因素身份驗證') }}
    </x-slot>

    <x-slot name="description">
        {{ __('使用雙因素身份驗證為您的帳號添加額外的安全保障。') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-zinc-900 dark:text-zinc-100 ">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('完成啟用雙因素身份驗證。') }}
                @else
                    {{ __('您已啟用雙因素身份驗證。') }}
                @endif
            @else
                {{ __('您尚未啟用雙因素身份驗證。') }}
            @endif
        </h3>

        <div class="max-w-xl mt-3 text-sm text-zinc-600 dark:text-zinc-300">
            <p>
                {{ __('當啟用雙因素身份驗證時，在身份驗證期間，您將被要求輸入一個安全的隨機號碼。您可以從您手機上的 Google Authenticator 應用程序中獲取此安全號碼。') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="max-w-xl mt-4 text-sm text-zinc-600 dark:text-zinc-300">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('要完成啟用雙因素身份驗證，請使用您手機的身份驗證器應用程序掃描以下QR CODE，或輸入設置密鑰並提供生成的 OTP 代碼。') }}
                        @else
                            {{ __('雙因素身份驗證已啟用。請使用您手機的身份驗證器應用程序掃描以下QR CODE，或輸入設置密鑰。') }}
                        @endif
                    </p>
                </div>

                <div class="inline-block p-2 mt-4 bg-white">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="max-w-xl mt-4 text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-label for="code" value="{{ __('安全碼') }}" />

                        <x-input id="code" type="text" name="code" class="block w-1/2 mt-1"
                            inputmode="numeric" autofocus autocomplete="one-time-code" wire:model="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="max-w-xl mt-4 text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('請將這些恢復代碼存儲在安全的密碼管理器中。如果您的雙因素身份驗證設備丟失，它們可以用於恢復訪問您的帳號。') }}
                    </p>
                </div>

                <div class="grid max-w-xl gap-1 px-4 py-4 mt-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (!$this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button type="button" wire:loading.attr="disabled">
                        {{ __('啟用') }}
                    </x-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button class="mr-3">
                            {{ __('重新產生恢復安全碼') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-button type="button" class="mr-3" wire:loading.attr="disabled">
                            {{ __('確認') }}
                        </x-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-secondary-button class="mr-3">
                            {{ __('顯示恢復安全碼') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-secondary-button wire:loading.attr="disabled">
                            {{ __('取消') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-danger-button wire:loading.attr="disabled">
                            {{ __('啟用') }}
                        </x-danger-button>
                    </x-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-action-section>
