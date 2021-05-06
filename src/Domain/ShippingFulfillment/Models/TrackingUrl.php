<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\TrackingUrlFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Fulfillment;

class TrackingUrl extends ShopifyModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fulfillment_id',
        'url',
    ];

    public function fulfillment()
    {
        return $this->belongsTo(Fulfillment::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return TrackingUrlFactory::new();
    }
}
