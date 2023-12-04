@props(['name', 'required' => false])

<div class="mb-4">
    <x-form-label :name="$name" />
    <input 
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline" 
        id="{{ $name }}" 
        name="{{ $name }}"
        placeholder="enter your {{ $name }}"
        type="text"
        value="{{ old($name) }}"
        {{ $required ? 'required' : '' }}
    >
    @error($name)
        <x-error-message>{{ $message }}</x-error-message>
    @enderror
</div>