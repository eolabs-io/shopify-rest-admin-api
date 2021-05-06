<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\DiscountAllocationFactory;

class DiscountAllocation extends ShopifyModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'line_item_id',
            'amount',
            'discount_application_index',
            'amount_set_id',
    ];

    public function lineItem()
    {
        return $this->belongsTo(LineItem::class);
    }

    public function amountSet()
    {
        return $this->belongsTo(Money::class, 'amount_set_id')->withDefault();
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return DiscountAllocationFactory::new();
    }
}
