@props(['tags'])

<div 
    class="space-x-2 flex flex-col h-20 overflow-y-auto xl:hidden"
>
    @foreach ($tags as $tag)
        <x-tag-link :tag="$tag" />
    @endforeach
</div>

<div 
    class="space-x-2 flex h-20 overflow-x-auto sm:max-xl:hidden"
>
    @foreach ($tags as $tag)
        <x-tag-link :tag="$tag" />
    @endforeach
</div>