<x-mail::message>

<x-mail::panel>
# a new message has been sent

{{ $user->name }} with email address {{ $user->email }} has sent a message to yactouat.com!

here it is =>

```
{{ $message }}
```
</x-mail::panel>

<!-- <x-mail::button :url="''">
Button Text
</x-mail::button> -->

from {{ config('app.name') }},

cheers!
</x-mail::message>
