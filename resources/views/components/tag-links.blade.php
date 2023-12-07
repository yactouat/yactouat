@props(['tags'])

<div class="space-x-2 flex max-md:flex-col max-lg:flex-row max-lg:overflow-x-auto">
    @foreach ($tags as $tag)
        <x-tag-link :tag="$tag" />
    @endforeach
</div>