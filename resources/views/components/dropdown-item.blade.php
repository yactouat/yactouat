@props(['active' => false])

@php
    $classes = 'block text-left px-3 text-sm leading-6 hover:bg-gray-400';
    if ($active) $classes .= ' bg-gray-400';
@endphp

<a 
    {{ $attributes(['class' => $classes]) }}
>
    {{ $slot }}
</a>