---
excerpt: Sometimes, "simple features" just go wrong and you explode any estimates you reasonably issued before working on the given task. How come we always get it wrong? For this particular case, I might have an answer.
tags: [dev-life, laravel]
thumbnail_img: checkmarks_that_hurt.png
title: checkmarks that hurt
---

Today I'm quite happy because, as it happens, I managed to stay consistent on day 2 of my blog release and on my commitment to ship something every day.

Today: I almost shipped 3 items of [this blog's GitHub issue](https://github.com/yactouat/yactouat/issues/26):

- [x] user should be able to subscribe/unsubscribe from emails from an email link
- [x] user should be able to subscribe/unsubscribe from emails from his profile page (for some reason I have a 401 on prod, so I'm gonna tackle this next)
- [x] user should be notified on a new post

3 little checkmarks... they took me like 4 hours to complete. I'm not even kidding. Once again I'm going to sleep late. But yet I maintain that I'm happy, I think unlocking the "ship it" mindset is a great achievement and that it will add great value to my skillset. This type of grind really helps learning stuff and get good reflexes in my craft.

So why was it so hard you might say?

## TL;DR: I tried to do several things at the same time

I'm talking about[this commit](https://github.com/yactouat/yactouat/commit/529e01060cbc538c5db21e9ba40c7d4109e469f8). My initial thought was "hey let's just notify the user when a new post is created". With Laravel mailables, it's laughibly simple to wire such logic. But, as I was executing this task, a lingering thought trapped me into the ship late loop: "users (e.g. my girlfriend) will think I'm a spammer if I send an email at each new blog post without giving them the option to unsubscribe".

So, I decided to ship the unsubscribe feature at the same time. I thought it would be easy, but it wasn't. I had to learn a lot of stuff, and I'm not even sure I'm doing it right. UX is a bitch, once you start thinking about your users, you may end up with a good product; but let's face it, it comes with a cost: everything becomes waaaay harder.

Here are some examples of what I had to do/learn for this `unsubscribe` link:

- modify some emails HTML layout to pass an `$unsubscribeUrl` variable
- create [a Laravel signed url](https://laravel.com/docs/10.x/urls#signed-urls) to create the link
- find a way to make sure that the incoming request is actually a signed URL
- make sure that a given URL belongs to a certain user
- log the user in when he/she clicks on the link to go to profile page to update the notifications setting of his/hers account
- create the form and the data structure of the account's notifications setting
- revoke the unsubscribe link once it is used (Laravel does not ship with that feature)
- implement the persistence layer for these signed routes that would make this possible
- account for the fact that the same hash is always generated for a given URL (e.g. the signature is idempotent), this means the signature itself is not good enough to identify an action
- parse encoded URLs to get the signature query parameter (this was quite dirty but hey it works 🤷)
- etc.

And I'm sure I missed items in this list!

To end this post, let me show you my signed route persistence layer; it's messy but functional =>

```php
<?php

namespace App\Services;

use App\Models\PersistedSignedRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

final class SignedRouteService
{

    /**
     * consumes a signed route
     * 
     * e.g. revokes it and logs user in
     * 
     * @param stdClass $persistedSignedRoute
     * @return void
     */
    public function consume($persistedSignedRoute)
    {
        // get signed route persisted record
        $persistedSignedRouteRecord = PersistedSignedRoute::find($persistedSignedRoute->id);

        // get user id from signed route
        $userId = $persistedSignedRouteRecord->user_id;

        // invalidate signed route
        $persistedSignedRouteRecord->revoked = true;
        $persistedSignedRouteRecord->save();

        // delete all persisted signed routes having same signature but not same id
        DB::table('persisted_signed_routes')
            ->where('signature', $persistedSignedRouteRecord->signature)
            ->where('id', '!=', $persistedSignedRouteRecord->id)
            ->delete();
        
        // log user in
        auth()->loginUsingId($userId);
    }

    public function fetch(Request $request)
    {
        try {
            $parsed = parse_url($request->fullUrl());
            parse_str($parsed['query'], $queryParameters);
            // it's a dirty job but someone's gotta do it
            $signature = $queryParameters["signature"] ?? $queryParameters["amp;signature"];
            $persistedSignedRoute = DB::table('persisted_signed_routes')
                ->where('user_id', $request->user)
                ->where('signature', $signature)
                ->where('revoked', false)
                ->first();
            return $persistedSignedRoute;
        } catch (\Throwable $th) {
            Log::channel('stderr')->error(json_encode([
                "msg" => "some funny business going on with a signed route",
                "data" => $request->fullUrl()
            ]));
            Log::channel('stderr')->error(json_encode([
                "msg" => $th->getMessage(),
                "data" => $request->fullUrl()
            ]));
            return null;
        }
    }

    /**
     * issue a signed route and save it to db (for unsubscribe link)
     * 
     * @param int $userId
     * @param string $routeName
     * @param mixed $param
     * @return string 
     */
    public function persist(int $userId, string $routeName, $paramName = null, $paramId = null): string
    {
        $url = URL::signedRoute(
            $routeName, 
            !$paramName ? ['user' => $userId] : [$paramName => $paramId, 'user' => $userId]
        );
        $persistedSignedRoute = new PersistedSignedRoute();
        $persistedSignedRoute->user_id = $userId;
        // get signature query param from url
        $urlParts = parse_url($url);
        parse_str($urlParts['query'], $queryParameters);
        $signature = $queryParameters['signature'];
        $persistedSignedRoute->signature = $signature;
        $persistedSignedRoute->save();
        return $url;
    }
}
```

These three methods pave the way for future OTP implementations, so I think it's quite cool.

Anyway, what was I saying? yea it's 1AM, I'm working tomorrow, and the checkmarks definitely hurt...