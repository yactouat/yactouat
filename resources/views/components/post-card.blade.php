@props(['post'])

<article
    {{ $attributes->merge(['class' => 'transition-colors duration-100 hover:bg-gray-200 border border-gray-400 border-opacity-0 hover:border-opacity-5 rounded-xl']) }}
>
    <div class="py-6 px-5">
        <div>
            <img 
                src="{{ $post->thumbnail_img }}" 
                alt="Blog Post illustration" 
                class="rounded-xl" 
                loading="lazy"
            >
        </div>

        <div class="mt-8 flex flex-col justify-between">
            <header>
                <div class="space-x-2">
                    @foreach ($post->tags as $tag)
                        <x-tag-link :tag="$tag" />
                    @endforeach
                </div>

                <div class="mt-4">
                    <h2 class="text-3xl">
                        <x-link href="/posts/{{ $post->slug }}">
                            {{ $post->title }}
                        </x-link>
                    </h2>

                    <span class="mt-2 block text-gray-500 text-xs">
                    last updated <time>{{ $post->updated_at->diffForHumans() }}</time>
                    </span>
                </div>
            </header>

            <div class="text-sm mt-4 space-y-4 h-20 overflow-y-auto">
                {{ $post->excerpt }}
            </div>

            <footer class="flex justify-between items-center mt-8">
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
