<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models;

use EolabsIo\ShopifyRestAdminApi\Database\Factories\ReceiptFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;

class Receipt extends ShopifyModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'testcase' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'testcase',
        'authorization',
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
        return ReceiptFactory::new();
    }
}
