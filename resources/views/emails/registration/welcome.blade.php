<x-mail::message unsubscribeUrl="{{ $unsubscribeUrl }}">

<x-mail::panel>
# welcome to yactouat.com

dear {{ $user->name }}, I am very happy to have you part of the yactouat.com community!

I hope you will find my content useful and enjoyable!

if you have any wishes, suggestions, feedback, questions, or if you just want to say hi, please do not hesitate to contact me @ {{ config('mail.reply_to.address') }}!
</x-mail::panel>

<!-- <x-mail::button :url="''">
Button Text
</x-mail::button> -->

from {{ config('app.name') }},

cheers!
</x-mail::message>
