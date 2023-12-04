<x-mail::message>

<x-mail::panel>
# a new message has been sent

user `{{ $user->name }}` with email address {{ $user->email }} has comment on post `{{ $post->title }}`!

here is the comment =>

```
{{ $comment }}
```
</x-mail::panel>

<!-- <x-mail::button :url="''">
Button Text
</x-mail::button> -->

from {{ config('app.name') }},

cheers!
</x-mail::message>
