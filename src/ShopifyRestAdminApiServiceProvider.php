<?php

namespace EolabsIo\ShopifyRestAdminApi;

use Illuminate\Support\ServiceProvider;

class ShopifyRestAdminApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'shopify-rest-admin-api');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'shopify-rest-admin-api');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('shopify-rest-admin-api.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/shopify-rest-admin-api'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/shopify-rest-admin-api'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/shopify-rest-admin-api'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'shopify-rest-admin-api');

        // Register the main class to use with the facade
        $this->app->singleton('shopify-rest-admin-api', function () {
            return new ShopifyRestAdminApi;
        });
    }
}
