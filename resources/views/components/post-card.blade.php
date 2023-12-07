@props(['post'])

<article
    {{ $attributes->merge(['class' => 'transition-colors duration-100 hover:bg-gray-200 border border-gray-400 border-opacity-0 hover:border-opacity-5 rounded-xl']) }}
>
    <div class="py-6 px-5">
        <div class="flex justify-center items-center h-2/4">
            <img 
                alt="blog post illustration" 
                class="rounded-xl post-card-thumbnail"
                loading="lazy"
                src="{{ $post->thumbnail_img }}" 
            >
        </div>

        <div class="mt-4 flex flex-col justify-between h-2/4 post-card-content-wrapper">
            <header class="h-1/3">
                <div class="space-x-2 mt-2 h-1/3">
                    @foreach ($post->tags as $tag)
                        <x-tag-link :tag="$tag" />
                    @endforeach
                </div>

                <div class="mt-4 h-2/3">
                    <h2 class="text-2xl">
                        <x-link href="/posts/{{ $post->slug }}">
                            {{ $post->title }}
                        </x-link>
                    </h2>

                    <span class="mt-2 block text-gray-500 text-xs">
                    last updated <time>{{ $post->updated_at->diffForHumans() }}</time>
                    </span>
                </div>
            </header>

            <div 
                class="text-md mt-4 space-y-4 h-1/3 overflow-y-auto post-card-excerpt"
                data-simplebar
            >
                {{ $post->excerpt }}
            </div>

            <footer class="flex justify-between items-center mt-8 h-1/3 post-card-footer">
                <div class="flex items-center text-sm">
                    <!-- TODO implement profile pic -->
                    <!-- <img src="/images/lary-avatar.svg" alt="Lary avatar"> -->
                    <div>
                        <h5 class="font-bold">by <x-link href="/?author={{ $post->author->username }}">{{ $post->author->name }}</x-link></h5>
                    </div>
                </div>

                <div>
                    <x-link-button 
                        href="/posts/{{ $post->slug }}"
                    >
                        read more
                    </x-link-button>
                </div>
            </footer>
        </div>
    </div>
</article>
