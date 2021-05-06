<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\PaymentDetails;

class PaymentDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'credit_card_bin' => null,
            'avs_result_code' => null,
            'cvv_result_code' => null,
            'credit_card_number' => "•••• •••• •••• 4242",
            'credit_card_company' => "Visa",
            'credit_card_name' => null,
            'credit_card_wallet' => null,
            'credit_card_expiration_month' => null,
            'credit_card_expiration_year' => null,
        ];
    }
}
