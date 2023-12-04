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
                <form method="post" action="/update-profile" class="bg-white rounded px-4 pt-6 pb-8 mb-4 mt-10">
                    @csrf
                    @method('PATCH')
                    <x-form-password-input 
                        autocomplete="new-password" 
                        name="password"
                        placeholder="enter your new password" 
                        required="{{ true }}" 
                    />
                    <div class="flex items-center justify-between">
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
