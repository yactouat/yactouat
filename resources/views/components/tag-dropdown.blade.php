<x-dropdown>
    <x-slot name="trigger">
        <button 
            class="py-2 px-8 text-sm font-semibold w-full lg:w-52 text-left flex lg:inline-flex"
        >
            {{ isset($activeTag) ? $activeTag->name : 'tags' }}

            <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;" width="22"
                height="22" viewBox="0 0 22 22">
                <g fill="none" fill-rule="evenodd">
                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                    </path>
                    <path fill="#222"
                            d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                </g>
            </svg>
        </button>
    </x-slot>
    <x-dropdown-item href="/">all</x-dropdown-item>
    @foreach($tags as $tag)
        <x-dropdown-item 
            href="/?tag={{ $tag->slug }}&{{ http_build_query(request()->except(['tag', 'page'])) }}"
            :active="!is_null($activeTag) && $activeTag->is($tag)"
        >{{ $tag->slug }}</x-dropdown-item>
    @endforeach
</x-dropdown>