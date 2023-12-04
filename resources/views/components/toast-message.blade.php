@php
    $id = 'toast-message';
    $classes = 'toast-message';
@endphp


<div
    {{ $attributes([
        'class' => $classes,
        'id' => $id
    ]) }}
>{{ $slot }}</div>
