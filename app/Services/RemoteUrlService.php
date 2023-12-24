<?php
declare(strict_types=1);

namespace App\Services;

final class RemoteUrlService
{
    public static function get(string $path): string
    {
        return config('filesystems.disks.gcp_public.url') . $path;
    }

    public static function prefix(): string
    {
        return env('APP_ENV') == "production" ? "prod/" : "dev/";
    }
}