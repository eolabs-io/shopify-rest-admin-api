<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models;

use EolabsIo\ShopifyRestAdminApi\Database\Factories\PriceFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;

class Price extends ShopifyModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currency_code',
        'amount',
    ];


    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return PriceFactory::new();
    }
}
