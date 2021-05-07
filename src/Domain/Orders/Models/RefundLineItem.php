<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Refund;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\RefundLineItemFactory;

class RefundLineItem extends ShopifyModel
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'refund_id',
        'line_item_id',
        'quantity',
        'location_id',
        'restock_type',
        'subtotal',
        'total_tax',
        'subtotal_set_id',
        'total_tax_set_id',
    ];

    public function refund()
    {
        return $this->belongsTo(Refund::class)->withDefault();
    }

    public function lineItem()
    {
        return $this->belongsTo(LineItem::class)->withDefault();
    }

    public function subtotalSet()
    {
        return $this->belongsTo(Money::class, 'subtotal_set_id')->withDefault();
    }

    public function totalTaxSet()
    {
        return $this->belongsTo(Money::class, 'total_tax_set_id')->withDefault();
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return RefundLineItemFactory::new();
    }
}
