@props(['tags'])

<div 
    class="space-x-2 flex flex-col h-20 overflow-y-auto"
    data-simplebar
>
    @foreach ($tags as $tag)
        <x-tag-link :tag="$tag" />
    @endforeach
</div>