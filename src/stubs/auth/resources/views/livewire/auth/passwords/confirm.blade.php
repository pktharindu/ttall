@section('title', __('Confirm your password'))

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="/">
            <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
        </a>

        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            {{ __('Confirm your password') }}
        </h2>
        
        <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
            {{ __('Please confirm your password before continuing') }}
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form wire:submit.prevent="confirm">
                <div>
                    <x-form-input name="password" type="password" :label="__('Password')" wire:model.lazy="password"
                        required autofocus />
                </div>

                <div class="flex items-center justify-end mt-6">
                    <div class="text-sm leading-5">
                        <a href="{{ route('password.request') }}"
                            class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <x-button wire:target="confirm">
                            {{ __('Confirm password') }}
                        </x-button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>