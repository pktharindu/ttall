<label for="{{ $name }}" class="block text-sm font-medium text-gray-700 leading-5">
    {{ $label }}
</label>

<div class="mt-1 rounded-md shadow-sm">
    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type ?? 'text' }}" {{ $attributes }}
        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error($name) border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
</div>

@error($name)
<p class="mt-2 text-sm text-red-600">{{ $message }}</p>
@enderror