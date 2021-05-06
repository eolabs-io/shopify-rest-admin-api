<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Providers;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Events\FetchOrder;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Command\OrderCommand;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Listeners\FetchOrderListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchOrder::class => [
            FetchOrderListener::class,
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
            OrderCommand::class,
        ]);
    }
}
