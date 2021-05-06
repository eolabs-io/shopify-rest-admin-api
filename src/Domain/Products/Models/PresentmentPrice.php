<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\Price;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductVariant;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\PresentmentPriceFactory;

class PresentmentPrice extends ShopifyModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_variant_id',
        'price_id',
        'compare_at_price_id',
    ];

    public function price()
    {
        return $this->belongsTo(Price::class, 'price_id')->withDefault();
    }

    public function compareAtPrice()
    {
        return $this->belongsTo(Price::class, 'compare_at_price_id')->withDefault();
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return PresentmentPriceFactory::new();
    }
}
