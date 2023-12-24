@props(['post'])

<article
    class="transition-colors duration-100 hover:bg-gray-200 border border-gray-400 border-opacity-0 hover:border-opacity-5 rounded-xl">
    <div class="py-6 px-5 lg:flex">
        <div class="flex-1 lg:mr-8 flex-col justify-center items-center">
            <img
                alt="Blog Post illustration"
                class="rounded-xl"
                src="{{ $post->thumbnail_img_web }}"
            >
            @if($post->thumbnail_ai_generated)
                <x-ai-generated-illustration />
            @else
                <p class="text-xs text-gray-500 my-2">{{ $post->thumbnail_img_alt }}</p>
            @endif
        </div>

        <div class="flex-1 flex flex-col justify-between">
            <header class="mt-8 lg:mt-0">
                <x-tag-links :tags="$post->tags" />

                <div class="mt-4">
                    <h3 class="text-4xl max-md:text-xl">
                        <x-link href="/posts/{{ $post->slug }}">
                            {{ $post->title }}
                        </x-link>
                    </h3>

                    <span class="mt-2 block text-gray-500 text-sm">
                        published <span>{{ $post->created_at->diffForHumans() }}</span>
                    </span>
                </div>
            </header>

            <div class="text-2xl mt-2 space-y-4">
                {{ $post->excerpt }}
            </div>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <!-- TODO implement profile pic -->
                    <!-- <img src="/images/lary-avatar.svg" alt="Lary avatar"> -->
                    <div>
                        <h4 class="font-bold">by <x-link href="/?author={{ $post->author->username }}">{{ $post->author->name }}</x-link></h4>
                    </div>
                </div>

                <div class="lg:block">
                    <x-link-button  href="/posts/{{ $post->slug }}">
                        read this blog article
                    </x-link-button>
                </div>
            </footer>
        </div>
    </div>
</article>