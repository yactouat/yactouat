<x-mail::message unsubscribeUrl="{{ $unsubscribeUrl }}">

<x-mail::panel>
# new post on yactouat.com!

dear {{ $user->name }}, my blog just got updated with some new content, check it out and let me know what you think!

here is a little excerpt:

> {{ $post->excerpt }}

I hope you will find this content useful and enjoyable!

feel free to comment on the post itself or share your thoughts directly with me via email @ {{ config('mail.reply_to.address') }}
</x-mail::panel>

<x-mail::button url="{{ $authedUrl }}">
read more
</x-mail::button>

from {{ config('app.name') }},

cheers!
</x-mail::message>
