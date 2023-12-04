<?php

namespace App\Services;

use App\Models\User;

class NewsletterService
{
    public function subscribe(User $user, string $providedEmailAddress): bool
    {
        if ($user->email === $providedEmailAddress) {
            $user->signed_up_for_newsletter = true;
            User::where('id', $user->id)->update(['signed_up_for_newsletter' => true]);
            return true;
        }
        return false;
    }
}