<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('更新密碼') }}
    </x-slot>

    <x-slot name="description">
        {{ __('請確保您的帳號使用長且隨機的密碼以保持安全。') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('當前密碼') }}" />
            <x-input id="current_password" type="password" class="block w-full mt-1" wire:model="state.current_password"
                autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('新密碼') }}" />
            <x-input id="password" type="password" class="block w-full mt-1" wire:model="state.password"
                autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('再輸入一次新密碼') }}" />
            <x-input id="password_confirmation" type="password" class="block w-full mt-1"
                wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('保存') }}
        </x-action-message>

        <x-button>
            {{ __('保存') }}
        </x-button>
    </x-slot>
</x-form-section>
