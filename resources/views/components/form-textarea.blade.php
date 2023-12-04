@props(['name', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'write your ' . $name . ' here'])

<div
    class="my-8"
>
    <textarea
        class="w-full rounded-xl p-4 resize-none overflow-y-auto text-sm focus:outline-none focus:ring border border-gray-400"
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        required
        rows="5"
    ></textarea>
    @error($name)
        <x-error-message>{{ $message }}</x-error-message>
    @enderror
</div>