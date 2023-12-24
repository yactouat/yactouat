<x-hr/>

<section class="max-w-6xl mx-auto px-6 py-2" id="app-contact">
    @auth
        <div class="text-center">
            <section class="px-6 py-8 max-md:px-0">
                <x-panel
                    class="max-w-4xl mx-auto my-10 bg-gray-200 max-md:w-full"
                >
                    <h2 class="text-center font-bold text-xl">contact me</h2>
                    <p class="text-black text-sm mb-6">(just be nice)</p>
                    <form method="post" action="/contact" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-10">
                        @csrf
                        <x-form-textarea 
                            name="message" 
                            placeholder="write your message here"
                            required="{{ true }}"
                        />
                        <div class="flex items-center justify-between">
                            <x-button
                                type="submit"
                            >
                                send
                            </x-button>
                        </div>
                    </form>
                </x-panel>
                <p class="text-gray-600">
                    or email me directly @ <a href="mailto:{{ config('mail.reply_to.address') }}" class="text-gray-500 hover:text-black">{{ config('mail.reply_to.address') }}</a>
                </p>
            </section>
        </div>
    @else
        <div class="text-center">
            <h2 class="text-center font-bold text-xl">contact me</h2>
            <x-register-login-cta>write me a message</x-register-login-cta> 
        </div>
    @endauth
</section>

<footer 
    class="max-w-6xl mx-auto mt-4 lg:mt-20 space-y-6"
    id="app-footer"
>
    @if(auth()->user()?->signed_up_for_newsletter)
        <div
            class="bg-gray-200 border border-gray-400 border-opacity-5 rounded-xl text-center py-16 mt-16"
        >
            <p>thank your for having subscribed to my newsletter <i class="fa-regular fa-face-smile"></i></p>
        </div>
    @elseif(auth()->user())
        <div 
            class="bg-gray-100 border border-gray-400 border-opacity-5 rounded-xl text-center py-16 px-10 mt-16"
            id="footer-newsletter"
        >
            <img 
                alt="envelope icon"
                class="mx-auto rounded-full shadow"
                loading="lazy"
                src="/images/newsletter-icon.webp"  
                style="width: 100px;">
            <h2 class="text-3xl">subscribe to my updates!</h2>
            <p class="text-sm mt-3">I promise I won't spam you</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">
                    <form method="POST" action="/signup-for-newsletter" class="lg:flex text-sm">
                        @csrf
                        <div 
                            class="flex items-center lg:w-72 max-md:w-64"
                        >
                            <label for="email-footer-input" class="hidden lg:inline-block">
                                <img 
                                    alt="mailbox icon" 
                                    class="rounded-full shadow"
                                    loading="lazy"
                                    src="/images/mailbox-icon.webp" 
                                    style="width: 40px;"
                                >
                            </label>
                            <input 
                                class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none lg:w-3/4 max-md:w-64"
                                id="email-footer-input" 
                                name="email"
                                type="text" 
                                placeholder="Your email address">
                        </div>
                        <x-button
                            type="submit"
                            class="max-md:w-64 max-md:mt-4"
                        >
                            subscribe
                        </x-button>
                    </form>
                </div>
                @error('email')
                    <x-error-message>{{ $message }}</x-error-message>
                @enderror
                <x-ai-generated-illustration />
            </div>
        </div>
    @else
        <x-register-login-cta>subscribe to the newsletter</x-register-login-cta>  
    @endif

    <div
        class="bg-gray-200 border border-gray-400 border-opacity-5 rounded-xl text-center py-16 mt-16 space-y-4"
    >
        <p>&copy; Yacine Touati</p>
        <x-button type="button" data-cc="c-settings">Manage cookie settings</x-button>
        <div class="flex justify-center items-center space-x-2">
            @if(request()->route()->uri() != 'impressum')<p class="underline"><x-link class="contrast-ratio-gray" href="/impressum">impressum</x-link></p>@endif
            @if(request()->route()->uri() != 'privacy-policy')<p class="underline"><x-link class="contrast-ratio-gray" href="/privacy-policy">privacy policy</x-link></p>@endif
        </div>
    </div>
</footer>