<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\PaymentDetails;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\TransactionFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Receipt;

class Transaction extends ShopifyModel
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
        'test' => 'boolean',
        'processed_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'order_id',
        'kind',
        'gateway',
        'status',
        'message',
        'created_at',
        'test',
        'authorization',
        'location_id',
        'user_id',
        'parent_id',
        'processed_at',
        'device_id',
        'error_code',
        'source_name',
        'receipt_id',
        'currency_exchange_adjustment_id',
        'amount',
        'currency',
        'admin_graphql_api_id',
        'payment_details_id',
    ];

    public function receipt()
    {
        $this->belongsTo(Receipt::class);
    }

    public function currencyExchangeAdjustment()
    {
        return $this->belongsTo(CurrencyExchangeAdjustment::class);
    }

    public function paymentDetails()
    {
        return $this->belongsTo(PaymentDetails::class, 'payment_details_id');
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return TransactionFactory::new();
    }
}
