<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models;

use EolabsIo\ShopifyRestAdminApi\Database\Factories\InventoryItemFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;

class InventoryItem extends ShopifyModel
{
    const CREATED_AT = 'model_created_at';
    const UPDATED_AT = 'model_updated_at';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'requires_shipping' => 'boolean',
        'tracked' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'sku',
        'created_at',
        'updated_at',
        'requires_shipping',
        'cost',
        'country_code_of_origin',
        'province_code_of_origin',
        'harmonized_system_code',
        'tracked',
        'country_harmonized_system_codes',
        'admin_graphql_api_id',
    ];


    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return InventoryItemFactory::new();
    }
}
