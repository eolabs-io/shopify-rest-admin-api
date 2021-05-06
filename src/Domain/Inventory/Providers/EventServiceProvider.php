<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Providers;

use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchLocation;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Command\LocationCommand;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchInventoryItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchInventoryLevel;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Command\InventoryItemCommand;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Command\InventoryLevelCommand;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Listeners\FetchLocationListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Listeners\FetchInventoryItemListener;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Listeners\FetchInventoryLevelListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchLocation::class => [
            FetchLocationListener::class,
        ],

        FetchInventoryItem::class => [
            FetchInventoryItemListener::class,
        ],

        FetchInventoryLevel::class => [
            FetchInventoryLevelListener::class,
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
            LocationCommand::class,
            InventoryItemCommand::class,
            InventoryLevelCommand::class,
        ]);
    }
}
