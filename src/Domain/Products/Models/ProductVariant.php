<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\PresentmentPrice;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\ProductVariantFactory;

class ProductVariant extends ShopifyModel
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
        'taxable' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'product_id',
        'title',
        'price',
        'sku',
        'position',
        'inventory_policy',
        'compare_at_price',
        'fulfillment_service',
        'inventory_management',
        'option1',
        'option2',
        'option3',
        'created_at',
        'updated_at',
        'taxable',
        'barcode',
        'grams',
        'image_id',
        'weight',
        'weight_unit',
        'inventory_item_id',
        'inventory_quantity',
        'old_inventory_quantity',
        'requires_shipping',
        'admin_graphql_api_id',
        'old_inventory_quantity',
        'requires_shipping',
    ];

    public function presentmentPrices()
    {
        return $this->hasMany(PresentmentPrice::class);
    }


    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return ProductVariantFactory::new();
    }
}
