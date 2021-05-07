<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\TaxLine;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\ShippingLineFactory;

class ShippingLine extends ShopifyModel
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'order_id',
        'code',
        'price',
        'price_set_id',
        'discounted_price',
        'discounted_price_set_id',
        'source',
        'title',
        'carrier_identifier',
        'requested_fulfillment_service_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }

    public function priceSet()
    {
        return $this->belongsTo(Money::class, 'price_set_id')->withDefault();
    }

    public function discountedPriceSet()
    {
        return $this->belongsTo(Money::class, 'discounted_price_set_id')->withDefault();
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
        return ShippingLineFactory::new();
    }
}
