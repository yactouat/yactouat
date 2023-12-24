@auth
    <form
        action="/posts/{{ $post->slug }}/comments"
        method="POST"
        class="lg:w-fullp-2 py-4 rounded-xl space-x-4 w-full"
    >
        @csrf
        <header class="rounded-xl flex items-center space-x-4">
            <!-- TODO implement profile pic -->
            <i class="fa-solid fa-user"></i>
            <h2>any thoughts? lead the discussion and post a comment!</h2>
        </header>
        <x-form-textarea 
            name="body" 
            placeholder="take part in the discussion!"
            required="{{ true }}"
        />
        <div class="mt-6 flex justify-end border-t border-gray-400 pt-6">
            <x-button type="submit">
                post comment
            </x-button>
        </div>
    </form>
    @if($errors->any())
        <script>
            document.getElementById('post-comments').scrollIntoView();
        </script>
    @endif
@else
    <h2>comments</h2>
    <x-register-login-cta>post a comment</x-register-login-cta>
@endauth