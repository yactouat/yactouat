<?php

namespace App\Providers;

use App\Mail\SendGridTransport;
use App\Models\User;
use App\Services\SendGridMailerService;
use App\Services\SignedRouteService;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services into the service container.
     */
    public function register(): void
    {
        // example of how to add something to the container
        app()->bind('SignedRouteService', fn() => new SignedRouteService());
    }

    /**
     * Bootstrap any application services at framework startup.
     */
    public function boot(): void
    {
        // defining gates
        Gate::define('admin', function(User $user) {
            return $user?->username === env('ADMIN_NAME') && $user?->email === env('ADMIN_EMAIL');
        });

        // force https in production (asset urls, etc)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // register gcp storage (both public and private)
        Storage::extend('gcp', function(Application $app, array $config) {
            $storageClient = new StorageClient([
                'keyFilePath' => $config['key_file_path'],
            ]);
            $bucket = $storageClient->bucket(config('filesystems.disks.gcp.bucket'));
            $adapter = new GoogleCloudStorageAdapter($bucket);
            return new FilesystemAdapter(
                new Filesystem($adapter, array_merge($config)),
                $adapter,
                $config
            );
        });
        Storage::extend('gcp_public', function(Application $app, array $config) {
            $storageClient = new StorageClient([
                'keyFilePath' => $config['key_file_path'],
            ]);
            $bucket = $storageClient->bucket(config('filesystems.disks.gcp.bucket'));
            $adapter = new GoogleCloudStorageAdapter($bucket);
            return new FilesystemAdapter(
                new Filesystem($adapter, array_merge($config, ['visibility' => 'public'])),
                $adapter,
                $config
            );
        });

        // register sendgrid mailer
        Mail::extend('sendgrid', function(array $config) {
            return new SendGridTransport(new SendGridMailerService());
        });
    }
}
