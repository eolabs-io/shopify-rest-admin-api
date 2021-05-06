<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers\Providers;

use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Events\FetchCustomer;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Command\CustomerCommand;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Listeners\FetchCustomerListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchCustomer::class => [
            FetchCustomerListener::class,
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
            CustomerCommand::class,
        ]);
    }
}
