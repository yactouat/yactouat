<x-mail::message>

<x-mail::panel>
# a new user has subscribed

{{ $user->name }} has subscribed to the newsletter with the email address {{ $user->email }}!
</x-mail::panel>

<!-- <x-mail::button :url="''">
Button Text
</x-mail::button> -->

from {{ config('app.name') }},

cheers!
</x-mail::message>
