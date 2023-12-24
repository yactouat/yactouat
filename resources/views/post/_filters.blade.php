<div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">
    <div class="relative lg:flex lg:inline-flex bg-gray-200 rounded-xl">
        <x-tag-dropdown />
    </div>
    <div class="relative flex lg:inline-flex items-center bg-gray-200 rounded-xl px-3 py-2">
        <form method="GET" action="/">
            @if (request('tag'))
                <input type="hidden" name="tag" value="{{ request('tag') }}">
            @endif
            <input 
                class="bg-transparent placeholder-black font-semibold text-sm focus:outline-none focus:ring"
                name="search" 
                placeholder="search content"
                type="text" 
                value="{{ request('search') }}">
        </form>
    </div> 
</div>
