<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Transaction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\PaymentDetails;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Receipt;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\CurrencyExchangeAdjustment;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(9),
            'order_id' => Order::factory(),
            'kind' => $this->faker->randomElement([
                'authorization',
                'capture',
                'sale',
                'void',
                'refund',
            ]),
            'gateway' => 'shopify_payments',
            'status' => $this->faker->randomElement([
                'pending',
                'failure',
                'success',
                'error',
            ]),
            'message' => $this->faker->text(),
            'created_at' => $this->faker->dateTime(),
            'test' => $this->faker->boolean(),
            'authorization' => $this->faker->text(),
            'location_id' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
            'parent_id' => $this->faker->randomNumber(),
            'processed_at' => $this->faker->dateTime(),
            'device_id' => $this->faker->randomNumber(),
            'error_code' => $this->faker->randomElement([
                'incorrect_number',
                'invalid_number',
                'invalid_expiry_date',
                'invalid_cvc',
                'expired_card',
                'incorrect_cvc',
                'incorrect_zip',
                'incorrect_address',
                'card_declined',
                'processing_error',
                'call_issuer',
                'pick_up_card',
            ]),
            'source_name' => $this->faker->randomElement([
                'web',
                'pos',
                'iphone',
                'android',
            ]),
            'receipt_id' => Receipt::factory(),
            'currency_exchange_adjustment_id' => CurrencyExchangeAdjustment::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 100),
            'currency' => $this->faker->currencyCode,
            'admin_graphql_api_id' => $this->faker->url,
            'payment_details_id' => PaymentDetails::factory(),
        ];
    }
}
