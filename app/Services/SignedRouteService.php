<?php

namespace App\Services;

use App\Models\PersistedSignedRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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

        
        // log user in
        auth()->loginUsingId($userId);
    }

    public function fetch(Request $request)
    {
        try {
            $signature = $request->query('signature');
            $inputDecrypted = Crypt::decryptString($signature);
            $inputDecryptedArray = explode('-', $inputDecrypted);
            $persistedSignedRoute = DB::table('persisted_signed_routes')
                ->where('signature', $signature)
                ->where('action', $inputDecryptedArray[1] ?? null)
                ->where('resource', $inputDecryptedArray[2] ?? null)
                ->where('path', '/' . $request->path())
                ->where('user_id', $inputDecryptedArray[0] ?? null)
                ->where('revoked', false)
                ->first();
            return $persistedSignedRoute;
        } catch (\Throwable $th) {
            Log::channel('stderr')->error(json_encode([
                "msg" => "some funny business going on with a signed route",
                "data" => $signature
            ]));
            Log::channel('stderr')->error(json_encode([
                "msg" => $th->getMessage(),
                "data" => $signature
            ]));
            return null;
        }
    }

    public function makeUrl(PersistedSignedRoute $persistedSignedRoute)
    {
        return url($persistedSignedRoute->path . '?signature=' . $persistedSignedRoute->signature);
    }

    /**
     * issues a signed route and saves it to db (for email authentification-based actions)
     * 
     * @param int $userId
     * @param string $action
     * @param string $resource
     * @param string $path
     * @return string 
     */
    public function persist(int $userId, string $action, string $resource, string $path): PersistedSignedRoute
    {

        $persistedSignedRoute = new PersistedSignedRoute();
        $persistedSignedRoute->user_id = $userId;
        $persistedSignedRoute->action = $action;
        $persistedSignedRoute->resource = $resource;
        $persistedSignedRoute->path = $path;
        $persistedSignedRoute->signature = Crypt::encryptString($userId . '-' . $action . '-' . $resource . '-' . Str::random(8));
        $persistedSignedRoute->save();
        return $persistedSignedRoute;
    }
}