@props(['comment'])

<x-panel
    class="lg:w-full bg-gray-200"
    id="post-comments"
>
    <article class="flex space-x-4">
        <div
            class="rounded-xl"
        >
            <!-- TODO implement profile pic -->
            <i class="fa-solid fa-user"></i>
        </div>
        <div>
            <header class="mb-4">
                <h2 class="font-bold"><x-link href="/?author={{ $comment->author->username }}">{{ $comment->author->name }}</x-link></h2> 
                <p class="text-xs">posted <span>{{ $comment->updated_at->diffForHumans() }}</span></p>
            </header>
            <div>
                {{ $comment->body }}
            </div>
        </div>
    </article>
</x-panel>
