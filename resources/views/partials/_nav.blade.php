<nav class="py-4 flex justify-end items-center max-md:flex-col">
    @auth
        @if(auth()->user()->signed_up_for_newsletter)
            <div>
                <span>next newsletter coming soon!</span>
                <i class="fa-solid fa-envelope"></i>
            </div>
        @else
            <x-link-button 
                href="#footer-newsletter"
            >
                <span>subscribe to updates</span>
                <i class="fa-solid fa-envelope"></i>
            </x-link-button>
        @endif
    @elseif(!request()->is('register'))
        <x-link class="space-x-1" href="/register">
            <span>register and subscribe to updates!</span>
            <i class="fa-solid fa-envelope"></i>
        </x-link>
    @endauth
    <div class="nav-auth px-5">
        @auth
            <x-link class="space-x-1" href="/profile">
                <span>{{ auth()->user()->name }}</span>
                <i class="fa-solid fa-user"></i>
            </x-link>
            <x-link class="space-x-1" href="/logout">
                <span>logout</span>
                <i class="fa-solid fa-right-from-bracket"></i>
            </x-link>
        @else
            @if(!request()->is('register'))
                <x-link class="space-x-1" href="/register">
                    <span>register</span>
                    <i class="fa-solid fa-user-plus"></i>
                </x-link>
            @endif
            @if(!request()->is('login'))
                <x-link class="space-x-1" href="/login">
                    <span>login</span>
                    <i class="fa-solid fa-right-to-bracket"></i>
                </x-link>
            @endif
        @endauth
    </div>
</nav>