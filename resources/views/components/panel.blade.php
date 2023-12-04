@php
    $classes = 'border border-gray-400 p-6 rounded-xl';
@endphp

<div 
    {{ $attributes(['class' => $classes]) }}
>
    {{ $slot }}
</div>