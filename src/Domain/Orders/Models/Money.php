<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\Price;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\MoneyFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;

class Money extends ShopifyModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_money_id',
        'presentment_money_id',
    ];

    public function shopMoney()
    {
        return $this->belongsTo(Price::class, 'shop_money_id')->withDefault();
    }

    public function presentmentMoney()
    {
        return $this->belongsTo(Price::class, 'presentment_money_id')->withDefault();
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return MoneyFactory::new();
    }
}
