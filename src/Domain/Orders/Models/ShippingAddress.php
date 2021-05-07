<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\ShippingAddressFactory;

class ShippingAddress extends ShopifyModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'first_name',
        'address1',
        'phone',
        'city',
        'zip',
        'province',
        'country',
        'last_name',
        'address2',
        'company',
        'latitude',
        'longitude',
        'name',
        'country_code',
        'province_code',
    ];



    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return ShippingAddressFactory::new();
    }
}
