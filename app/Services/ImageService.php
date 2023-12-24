<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Storage;

final class ImageService
{
    public static function storeOriginalAndWebImages(string $originalImageFileName): array
    {
        // calling `webp` on the filename will convert it to webp
        exec('cwebp -q 80 ' . base_path('content/images') . '/' . $originalImageFileName . ' -o ' . base_path('content/images') . '/' . $originalImageFileName . '.webp');
        $webPImagePath = base_path('content/images') . '/' . $originalImageFileName . '.webp';
        Storage::disk('gcp_public')
            ->put(
                RemoteUrlService::prefix() . 'images/' . $originalImageFileName, 
                file_get_contents(base_path('content/images') . '/' . $originalImageFileName)
            );
        Storage::disk('gcp_public')
            ->put(
                RemoteUrlService::prefix() . 'images/' . $originalImageFileName . '.webp', 
                file_get_contents($webPImagePath)
            );
        $remoteWebImagePath = RemoteUrlService::get(RemoteUrlService::prefix() . 'images/' . $originalImageFileName . '.webp');
        $remoteOriginalImagePath = RemoteUrlService::get(RemoteUrlService::prefix() . 'images/' . $originalImageFileName);
        return [
            'remoteWebImagePath' => $remoteWebImagePath,
            'remoteOriginalImagePath' => $remoteOriginalImagePath,
        ];
    }

}