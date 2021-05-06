<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\PaymentDetailsFactory;

class PaymentDetails extends ShopifyModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'credit_card_bin',
        'avs_result_code',
        'cvv_result_code',
        'credit_card_number',
        'credit_card_company',
        'credit_card_name',
        'credit_card_wallet',
        'credit_card_expiration_month',
        'credit_card_expiration_year',
    ];

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return PaymentDetailsFactory::new();
    }
}
