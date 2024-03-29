<x-action-section>
    <x-slot name="title">
        {{ __('刪除帳戶') }}
    </x-slot>

    <x-slot name="description">
        {{ __('永久刪除您的帳戶') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-zinc-600 dark:text-zinc-300">
            {{ __('一旦您的帳戶被刪除，它的所有資源和數據都將被永久刪除。在刪除您的帳戶之前，請保留您需要的任何數據或訊息。') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('刪除帳戶') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('刪除帳戶') }}
            </x-slot>

            <x-slot name="content">
                {{ __('您確定要刪除您的帳戶嗎？一旦您的帳戶被刪除，它的所有資源和數據都將被永久刪除。請確認您要永久刪除您的帳戶，請輸入您的密碼。') }}

                <div class="mt-4" x-data="{}"
                    x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="block w-3/4 mt-1" autocomplete="current-password"
                        placeholder="{{ __('密碼') }}" x-ref="password" wire:model="password"
                        wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('取消') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('刪除帳戶') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
