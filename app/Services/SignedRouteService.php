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