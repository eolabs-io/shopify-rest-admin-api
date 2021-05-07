<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ShippingLine;

class ShippingLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingLine::class;

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
            'code' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'price_set_id' => Money::factory(),
            'discounted_price' => $this->faker->randomFloat(2, 0, 100),
            'discounted_price_set_id' => Money::factory(),
            'source' => $this->faker->text(),
            'title' => $this->faker->text(),
            'carrier_identifier' => $this->faker->text(),
            'requested_fulfillment_service_id' => $this->faker->text(),
        ];
    }
}
