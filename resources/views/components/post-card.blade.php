@props(['post'])

<article
    {{ $attributes->merge(['class' => 'transition-colors duration-100 hover:bg-gray-200 border border-gray-400 border-opacity-0 hover:border-opacity-5 rounded-xl post-card']) }}
>
    <div class="py-6 px-5">
        <div class="flex flex-col justify-center items-center post-card-thumbnail-wrapper">
            <img 
                alt="{{ $post->thumbnail_img_alt }}" 
                class="rounded-xl post-card-thumbnail"
                loading="lazy"
                src="{{ $post->thumbnail_img_web }}" 
            >
            @if($post->thumbnail_ai_generated)
                <x-ai-generated-illustration />
            @else
                <p class="text-xs text-gray-500 my-2 self-start">{{ $post->thumbnail_img_alt }}</p>
            @endif
        </div>

        <div class="mt-4 flex flex-col justify-between post-card-content-wrapper">
            <header>
                <x-tag-links :tags="$post->tags"/>

                <div class="mt-4">
                    <h2 class="text-2xl h-16 overflow-y-auto">
                        <x-link href="/posts/{{ $post->slug }}">
                            {{ $post->title }}
                        </x-link>
                    </h2>

                    <span class="mt-2 block text-gray-500 text-xs">
                    published <time>{{ $post->created_at->diffForHumans() }}</time>
                    </span>
                </div>
            </header>

            <div 
                class="text-md mt-4 space-y-4 overflow-y-auto post-card-excerpt"
                data-simplebar
            >
                {{ $post->excerpt }}
            </div>

            <footer class="flex justify-between items-center mt-8 post-card-footer">
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
