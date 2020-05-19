@section('title', __('Reset password'))

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="/">
            <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
        </a>

        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            {{ __('Reset password') }}
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form wire:submit.prevent="passwordReset">
                <input wire:model="token" type="hidden">

                <div>
                    <x-form-input name="email" type="email" :label="__('Email address')" wire:model.lazy="email"
                        required autofocus />
                </div>

                <div class="mt-6">
                    <x-form-input name="password" type="password" :label="__('Password')" wire:model.lazy="password"
                        required />
                </div>

                <div class="mt-6">
                    <x-form-input name="password_confirmation" type="password" :label="__('Confirm Password')"
                        wire:model.lazy="password_confirmation" required />
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <x-button wire:target="passwordReset">
                            {{ __('Reset password') }}
                        </x-button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
