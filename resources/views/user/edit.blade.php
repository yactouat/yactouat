@extends('components.layout')

@section('title', 'profile')

@section('content')
    <section class="px-6 py-8 max-md:px-0">
        <x-panel
            class="max-w-lg mx-auto my-10 bg-gray-200 max-md:w-full"
        >
            <!-- update account section -->
            <div class="bg-white rounded px-4 pt-6 pb-8 mb-4">
                <h2 class="text-center font-bold text-xl">update profile data</h2>
                <form method="post" action="/update-profile" class="bg-white rounded px-4 pt-6 pb-8 mb-4 mt-10 space-y-4">
                    @csrf
                    @method('PATCH')
                    <x-form-password-input 
                        autocomplete="new-password" 
                        name="password"
                        placeholder="****" 
                    />
                    <x-small>leave blank to keep current password</x-small>
                    <div class="flex items-center">
                        <label for="notify_on_blog_post" class="mr-2">be notified on new blog post</label>
                        <input
                            id="notify_on_blog_post"
                            name="notify_on_blog_post"
                            type="checkbox"  
                            {{ $user->notify_on_blog_post ? 'checked' : '' }}
                        >
                    </div>
                    <div class="flex items-center">
                        <x-button
                            type="submit"
                        >
                            update
                        </x-button>
                    </div>
                </form>
            </div>

            <!-- delete account section -->
            <div class="bg-white rounded px-4 pt-6 pb-8 mb-4">
                <form method="post" action="/delete-profile" class="bg-white rounded px-4 pt-6 pb-8 mb-4 mt-10">
                    @csrf
                    @method('DELETE')
                    <h2 class="text-center font-bold text-xl text-red-500">delete your account</h2>
                    <p class="my-4 flex justify-center items-center space-x-2">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>this action cannot be undone</span>
                    </p>
                    <div class="flex items-center justify-center">
                        <x-button
                            class="bg-red-500 hover:bg-red-700 text-white font-bold"
                            type="submit"
                        >
                            update
                        </x-button>
                    </div>
                </form>
            </div>

        </x-panel>
    </section>
@endsection
