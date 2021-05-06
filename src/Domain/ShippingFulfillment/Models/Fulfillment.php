<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\FulfillmentFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Receipt;

class Fulfillment extends ShopifyModel
{
    const CREATED_AT = 'model_created_at';
    const UPDATED_AT = 'model_updated_at';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'notify_customer' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'order_id',
        'status',
        'created_at',
        'service',
        'updated_at',
        'tracking_company',
        'shipment_status',
        'location_id',
        'tracking_number',
        'tracking_url',
        'receipt_id',
        'name',
        'admin_graphql_api_id',
        'notify_customer',
        'variant_inventory_management',
    ];


    public function receipt()
    {
        return $this->belongsTo(Receipt::class)->withDefault();
    }

    public function lineItems()
    {
        return $this->belongsToMany(LineItem::class);
    }

    public function trackingNumbers()
    {
        return $this->hasMany(TrackingNumber::class);
    }

    public function trackingUrls()
    {
        return $this->hasMany(TrackingUrl::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return FulfillmentFactory::new();
    }
}
