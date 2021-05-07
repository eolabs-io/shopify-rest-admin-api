<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountApplication;

class DiscountApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DiscountApplication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'type' => $this->faker->randomElement([
                'automatic',
                'discount_code',
                'manual',
                'script',
            ]),
            'value' => $this->faker->randomFloat(2, 0, 100),
            'value_type' => $this->faker->randomElement([
                'fixed_amount',
                'percentage',
            ]),
            'allocation_method' => $this->faker->randomElement([
                'across',
                'each',
                'one',
            ]),
            'target_selection' => $this->faker->randomElement([
                'all',
                'entitled',
                'explicit',
            ]),
            'target_type' => $this->faker->randomElement([
                'line_item',
                'shipping_line',
            ]),
            'code' => $this->faker->text(10),
        ];
    }
}
