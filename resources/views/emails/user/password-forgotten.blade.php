<x-mail::message unsubscribeUrl="{{ $unsubscribeUrl }}">

<x-mail::panel>
# yactouat.com: forgot password?

dear {{ $user->name }}, it's okay to forget thinhs, click on the button below to reset your password!

thank you for being part of yactouat.com community,

if you have any wishes, suggestions, feedback, questions, or if you just want to say hi, please do not hesitate to contact me @ {{ config('mail.reply_to.address') }}!
</x-mail::panel>

<!-- using the same url as the unsubscribe url since it leads to profile edit page -->
<x-mail::button :url="$unsubscribeUrl">
reset password
</x-mail::button>

from {{ config('app.name') }},

cheers!
</x-mail::message>
