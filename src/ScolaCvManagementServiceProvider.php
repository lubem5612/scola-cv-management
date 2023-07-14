<?php

namespace Transave\ScolaCvManagement;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Transave\ScolaCvManagement\Helpers\PublishMigrations;
use Transave\ScolaCvManagement\Http\Models\User;

class ScolaCvManagementServiceProvider extends ServiceProvider
{
    use PublishMigrations;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/scolacv.php', 'scolacv');
        $this->mergeConfigFrom(__DIR__.'/../config/endpoints.php', 'endpoints');

        // Register the service the package provides.
        $this->app->singleton('scolacv', function ($app) {
            return new ScolaCvManagement;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cbt');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->registerRoutes();

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        Config::set('auth.defaults', [
            'guard' => 'api',
            'passwords' => 'users',
        ]);

        Config::set('auth.guards.api', [
            'driver' => 'session',
            'provider' => 'users',
            'hash' => false,
        ]);

        Config::set('auth.providers.users', [
            'driver' => 'eloquent',
            'model' => User::class,
        ]);

        Config::set('filesystems.disks.azure', [
            'driver'            => 'azure',
            'local_address'     => env('AZURE_STORAGE_LOCAL_ADDRESS', 'local'),
            'name'              => env('AZURE_STORAGE_NAME', 'raadaastorage'),
            'key'               => env('AZURE_STORAGE_KEY', ''),
            'container'         => env('AZURE_STORAGE_CONTAINER', "raadaatesting"),
            'prefix'            => env('AZURE_STORAGE_PREFIX', "scola-cbt"),
            'url'               => env('AZURE_STORAGE_URL', null),
        ]);
    }

    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/scolacv.php' => config_path('scolacv.php'),
        ], 'cv-config');

        // Publishing migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'cv-migrations');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/cv'),
        ], 'views');

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['scolacv'];
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
        Route::middleware('web')->prefix('cv')->group(function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('scolacv.route.prefix'),
            'middleware' => config('scolacv.route.middleware'),
        ];
    }
}
