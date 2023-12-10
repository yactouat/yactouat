@props(['tags'])

<div 
    class="space-x-2 flex flex-col max-h-20 overflow-y-auto"
    data-simplebar
>
    @foreach ($tags as $tag)
        <x-tag-link :tag="$tag" />
    @endforeach
</div>