<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Refund;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\OrderAdjustment;

class OrderAdjustmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderAdjustment::class;

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
            'refund_id' => Refund::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 100),
            'tax_amount' => $this->faker->randomFloat(2, 0, 100),
            'kind' => $this->faker->randomElement([
                'shipping_refund',
                'refund_discrepancy'
            ]),
            'reason' => $this->faker->text(),
            'amount_set_id' => Money::factory(),
            'tax_amount_set_id' => Money::factory(),
        ];
    }
}
