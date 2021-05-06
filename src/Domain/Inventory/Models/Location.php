<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models;

use EolabsIo\ShopifyRestAdminApi\Database\Factories\LocationFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;

class Location extends ShopifyModel
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
        'legacy' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'address1',
        'address2',
        'city',
        'zip',
        'province',
        'country',
        'phone',
        'created_at',
        'updated_at',
        'country_code',
        'country_name',
        'province_code',
        'legacy',
        'active',
        'admin_graphql_api_id',
    ];


    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return LocationFactory::new();
    }
}
