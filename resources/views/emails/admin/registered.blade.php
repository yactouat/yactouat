<x-mail::message>

<x-mail::panel>
# a new user has registered

{{ $user->name }} has registered with the email address {{ $user->email }}!
</x-mail::panel>

<!-- <x-mail::button :url="''">
Button Text
</x-mail::button> -->

from {{ config('app.name') }},

cheers!
</x-mail::message>
