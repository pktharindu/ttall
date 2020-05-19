<button type="{{ $type ?? 'submit' }}" {{ $attributes }} wire:loading.class.remove="bg-indigo-600"
    wire:loading.class="bg-indigo-500 cursor-wait" wire:loading.attr="disabled"
    class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
    {{ $slot }}
</button>