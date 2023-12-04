@extends('components.layout')

@section('title', 'login')

@section('content')
    <section class="px-6 py-8 max-md:px-0">
        <x-panel
            class="max-w-lg mx-auto my-10 bg-gray-200 max-md:w-full"
        >
            <h2 class="text-center font-bold text-xl">login</h2>
            <form method="post" action="/login" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-10">
                @csrf
                <x-form-email-input name="email" required="{{ true }}" />
                <x-form-password-input name="password" required="{{ true }}" autocomplete="current-password"/>
                <div class="flex items-center justify-between">
                    <x-button 
                        type="submit"
                    >
                        login
                    </x-button>
                </div>
            </form>
        </x-panel>
    </section>
@endsection
