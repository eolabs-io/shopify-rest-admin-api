<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\Location;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryItem;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\InventoryLevelFactory;

class InventoryLevel extends ShopifyModel
{
    const CREATED_AT = 'model_created_at';
    const UPDATED_AT = 'model_updated_at';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_item_id',
        'location_id',
        'available',
        'updated_at',
        'admin_graphql_api_id',
    ];

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return InventoryLevelFactory::new();
    }
}
