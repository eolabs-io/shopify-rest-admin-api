<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Customer;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\AddressFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;

class Address extends ShopifyModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'default' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'customer_id',
        'first_name',
        'last_name',
        'company',
        'address1',
        'address2',
        'city',
        'province',
        'country',
        'zip',
        'phone',
        'name',
        'province_code',
        'country_code',
        'country_name',
        'default',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return AddressFactory::new();
    }
}
