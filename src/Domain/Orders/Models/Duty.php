<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\Price;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\TaxLine;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\DutyFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;

class Duty extends ShopifyModel
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'line_item_id',
        'harmonized_system_code',
        'country_code_of_origin',
        'shop_money_id',
        'presentment_money_id',
    ];

    public function lineItem()
    {
        return $this->belongsTo(LineItem::class)->withDefault();
    }

    public function shopMoney()
    {
        return $this->belongsTo(Price::class, 'shop_money_id')->withDefault();
    }

    public function presentmentMoney()
    {
        return $this->belongsTo(Price::class, 'presentment_money_id')->withDefault();
    }

    public function taxLines()
    {
        return $this->belongsToMany(TaxLine::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return DutyFactory::new();
    }
}
