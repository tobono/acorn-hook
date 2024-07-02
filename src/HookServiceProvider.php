<?php

namespace Tobono\Hook;

use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('action', function () {
            return new ActionRepository();
        });

        $this->app->singleton('filter', function () {
            return new FilterRepository();
        });
    }
}
