<?php

namespace Transave\ScolaCvManagement;

use Illuminate\Support\ServiceProvider;

class ScolaCvManagementServiceProvider extends ServiceProvider
{
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
    }
}
