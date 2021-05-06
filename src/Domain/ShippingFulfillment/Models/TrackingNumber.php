<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\TrackingNumberFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Fulfillment;

class TrackingNumber extends ShopifyModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fulfillment_id',
        'number',
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
        return TrackingNumberFactory::new();
    }
}
