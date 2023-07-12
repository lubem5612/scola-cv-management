<?php

namespace Transave\ScolaCvManagement;

use Illuminate\Support\ServiceProvider;
use Transave\ScolaCvManagement\Helpers\PublishMigrations;

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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

    }

    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/scola-cbt.php' => config_path('scola-cbt.php'),
        ], 'cbt-config');

        // Publishing migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'cbt-migrations');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/cbt'),
        ], 'views');

    }


}
