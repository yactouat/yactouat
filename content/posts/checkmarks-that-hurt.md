---
excerpt: Sometimes, "simple features" just go wrong and you explode any estimates you reasonably issued before working on the actual task. How come we always get it wrong? For this particular case, I might have an answer.
tags: [dev-life, laravel]
thumbnail_img: checkmarks_that_hurt.png
title: checkmarks that hurt
---

I'm quite happy because, as it happens, I managed to stay consistent on day 2 of my blog release and on my commitment to ship something every day.

Today: I shipped 3 items of [this blog's GitHub issue](https://github.com/yactouat/yactouat/issues/26):

- [x] user should be able to subscribe/unsubscribe from emails from an email link
- [x] user should be able to subscribe/unsubscribe from emails from his profile page
- [x] user should be notified on a new post

3 little checkmarks... they took me like 4 hours to complete. I'm not even kidding. Once again I'm going to sleep late. But yet I maintain that I'm happy, I think unlocking the "ship it" mindset is a great achievement and that it will add great value to my skillset.

So why was it so hard you might say?

## The root of my own personal evil: doing everything at the same time

I'm talking about[this commit](https://github.com/yactouat/yactouat/commit/529e01060cbc538c5db21e9ba40c7d4109e469f8). My initial thought was "hey let's just notify the user when a new post is created". With Laravel mailables, it's laughibly simple to wire such logic. But, as I was executing this task, a lingering thought trapped me into the ship late loop: "users (e.g. my girlfriend) will think I'm a spammer if I send an email at each new blog post without giving them the option to unsubscribe".

UX is a bitch, once you start thinking about your users, you end up with a good product but everything becomes harder.

In order to create the `unsubscribe` link, I had to / learned:

- modify some emails HTML layout to pass an `$unsubscribeUrl` variable
- create [a Laravel signed url](https://laravel.com/docs/10.x/urls#signed-urls) to create the link
- but then again how to make sure that the incoming request is a signed URL?
- also how to make sure that this URL actually belongs to a given user?
- moreover, I realized it was necessary to log the user in when he goes to the unsubscribe link (since he may not be signed in at all)
- this caused a security issue as anyone who gets the link a second time to access the user's account
- Laravel does not ship with the ability to revoke signed urls by default, so I had to create a layer of persistence for such urls with a `revoked` attribute
- what's funny is that the same URL is generated over and over again, the signature hash is idempotent; how come? I think the extreme modularity of the framework causes this kind of discrepancy between places where `bcrypt` is used by default and places where it's not when it should be IMHO (e.g. signed urls)
- knowing that I had to do something quite dirty: manually deleting the previous signed urls when a new one is generated, anyway, let's stop rambling, let me show you my signed route persistence layer; it's messy but hey it works 🤷 =>

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
            $signature = $queryParameters["amp;signature"];
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