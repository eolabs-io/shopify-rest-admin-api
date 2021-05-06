<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Providers;

use EolabsIo\ShopifyRestAdminApi\Domain\Products\Events\FetchProduct;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Command\ProductCommand;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Listeners\FetchProductListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchProduct::class => [
            FetchProductListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Registering package commands.
        $this->commands([
            ProductCommand::class,
        ]);
    }
}
