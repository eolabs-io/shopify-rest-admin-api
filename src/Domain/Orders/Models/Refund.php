<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Duty;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\RefundFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Transaction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\RefundLineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\OrderAdjustment;

class Refund extends ShopifyModel
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
        'created_at',
        'note',
        'user_id',
        'processed_at',
        // 'restock',
        'admin_graphql_api_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function duties()
    {
        return $this->belongsToMany(Duty::class);
    }

    public function refundDuties()
    {
        return $this->hasMany(RefundDuty::class);
    }

    public function refundLineItems()
    {
        return $this->hasMany(RefundLineItem::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class);
    }

    public function orderAdjustments()
    {
        return $this->hasMany(OrderAdjustment::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return RefundFactory::new();
    }
}
