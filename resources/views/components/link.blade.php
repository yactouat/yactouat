@php
    $classes = 'transition-colors duration-100 font-semibold text-gray-500 hover:text-black';
@endphp

<a 
    {{ $attributes(['class' => $classes]) }}
>{{ $slot }}</a>