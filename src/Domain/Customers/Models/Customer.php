<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\CustomerFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\TaxExemption;

class Customer extends ShopifyModel
{
    const CREATED_AT = 'model_created_at';
    const UPDATED_AT = 'model_updated_at';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'accepts_marketing' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'verified_email' => 'boolean',
        'tax_exempt' => 'boolean',
        'accepts_marketing_updated_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'email',
        'accepts_marketing',
        'created_at',
        'updated_at',
        'first_name',
        'last_name',
        'orders_count',
        'state',
        'total_spent',
        'last_order_id',
        'note',
        'verified_email',
        'multipass_identifier',
        'tax_exempt',
        'phone',
        'tags',
        'last_order_name',
        'currency',
        'accepts_marketing_updated_at',
        'marketing_opt_in_level',
        'admin_graphql_api_id',
        'default_address_id',
    ];

    public function defaultAddress()
    {
        return $this->belongsTo(Address::class, 'default_address_id')->withDefault();
    }

    public function taxExemptions()
    {
        return $this->belongsToMany(TaxExemption::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return CustomerFactory::new();
    }
}
