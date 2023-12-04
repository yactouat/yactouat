<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class SystemsStatusResolverService
{
    public static function resolve()
    {
        $systemStatus = collect([]);

        $postgresStatus = false;
        try {
            DB::select("SELECT 1");
            $postgresStatus = true;
        } catch (\Throwable $th) {
            Log::channel('stderr')->error(json_encode([
                "msg" => $th->getMessage(),
                "data" => config('database.connections.pgsql')
            ]));
        }
        $systemStatus->add($postgresStatus);

        $redisStatus = false;
        try {
            Redis::connection()->isConnected();
            $redisStatus = true;
        } catch (\Throwable $th) {
            Log::channel('stderr')->error(json_encode([
                "msg" => $th->getMessage(),
                "data" => config('database.redis')
            ]));
        }
        $systemStatus->add($redisStatus);

        // if all systems are up, return checkmark
        if ($systemStatus->every(function ($value, $key) {
            return $value === true;
        })) {
            return "🟢";
        }
        else if ($systemStatus->every(function ($value, $key) {
            return $value === false;
        })) {
            return "🔴";
        }
        else {
            return "🟠";
        }
    }
}