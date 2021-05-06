<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Refund;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\RefundDutyFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;

class RefundDuty extends ShopifyModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'duty_id',
        'refund_id',
        'refund_type',
    ];

    public function return()
    {
        return $this->belongsTo(Refund::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return RefundDutyFactory::new();
    }
}
