<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\TaxLine;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Property;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\LineItemFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountAllocation;

class LineItem extends ShopifyModel
{
    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'requires_shipping' => 'boolean',
        'taxable' => 'boolean',
        'gift_card' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'order_id',
        'variant_id',
        'title',
        'quantity',
        'sku',
        'variant_title',
        'vendor',
        'fulfillment_service',
        'product_id',
        'requires_shipping',
        'taxable',
        'gift_card',
        'name',
        'variant_inventory_management',
        'product_exists',
        'fulfillable_quantity',
        'grams',
        'price',
        'total_discount',
        'fulfillment_status',
        'price_set_id',
        'total_discount_set_id',
        'admin_graphql_api_id',
    ];

    public function order()
    {
        $this->belongsTo(Order::class)->withDefault();
    }

    public function priceSet()
    {
        return $this->belongsTo(Money::class, 'price_set_id')->withDefault();
    }

    public function totalDiscountSet()
    {
        return $this->belongsTo(Money::class, 'total_discount_set_id')->withDefault();
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function discountAllocations()
    {
        return $this->hasMany(DiscountAllocation::class);
    }

    public function duties()
    {
        return $this->hasMany(Duty::class);
    }

    public function taxLines()
    {
        return $this->belongsToMany(TaxLine::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return LineItemFactory::new();
    }
}
