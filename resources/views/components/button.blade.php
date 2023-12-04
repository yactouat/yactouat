@php
    $classes = 'transition-colors duration-100 text-sm font-semibold bg-gray-200 hover:bg-gray-400 hover:text-white rounded-full py-2 px-8';
@endphp

<button 
    {{ $attributes(['class' => $classes]) }}
>
    {{ $slot }}
</button>