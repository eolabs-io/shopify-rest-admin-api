<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Refund;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\OrderAdjustmentFactory;

class OrderAdjustment extends ShopifyModel
{
    public $incrementing = false;

    protected $hidden = ['pivot'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'order_id',
        'refund_id',
        'amount',
        'tax_amount',
        'kind',
        'reason',
        'amount_set_id',
        'tax_amount_set_id',
    ];

    public function order()
    {
        $this->belongsTo(Order::class);
    }

    public function refund()
    {
        $this->belongsTo(Refund::class);
    }

    public function amountSet()
    {
        $this->belongsTo(Money::class, 'amount_set_id');
    }

    public function taxAmountSet()
    {
        $this->belongsTo(Money::class, 'tax_amount_set_id');
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return OrderAdjustmentFactory::new();
    }
}
