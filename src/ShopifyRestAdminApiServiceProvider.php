<?php

namespace EolabsIo\ShopifyRestAdminApi;

use Illuminate\Support\ServiceProvider;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Product;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Customer;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Location;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\InventoryItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\InventoryLevel;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Providers\EventServiceProvider as OrdersEventServiceProvider;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Providers\EventServiceProvider as ProductsEventServiceProvider;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Providers\EventServiceProvider as CustomersEventServiceProvider;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Providers\EventServiceProvider as InventoryEventServiceProvider;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Middleware\ShopifyThrottlingMiddleware;

class ShopifyRestAdminApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if (Shopify::$runsMigrations) {
                $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            }

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations/shopify'),
            ], 'shopify-migrations');

            $this->publishes([
                __DIR__.'/../config/walmart.php' => config_path('shopify.php'),
            ], 'shopify-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->register(ProductsEventServiceProvider::class);
        $this->app->register(OrdersEventServiceProvider::class);
        $this->app->register(CustomersEventServiceProvider::class);
        $this->app->register(InventoryEventServiceProvider::class);

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/shopify.php', 'shopify');

        // Register the main class to use with the facade
        $this->app->singleton('shopify-admin-api-product', function () {
            return new Product;
        });

        $this->app->singleton('shopify-admin-api-order', function () {
            return new Order;
        });

        $this->app->singleton('shopify-admin-api-customer', function () {
            return new Customer;
        });

        $this->app->singleton('shopify-admin-api-location', function () {
            return new Location;
        });

        $this->app->singleton('shopify-admin-api-inventory-item', function () {
            return new InventoryItem;
        });

        $this->app->singleton('shopify-admin-api-inventory-level', function () {
            return new InventoryLevel;
        });

        $this->app->singleton('shopify-throttling-middleware', function () {
            return new ShopifyThrottlingMiddleware;
        });
    }
}
