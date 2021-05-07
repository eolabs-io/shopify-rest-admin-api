<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Refund;

class RefundFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Refund::class;

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
            'created_at' => $this->faker->dateTime(),
            'note' => $this->faker->text(),
            'user_id' => $this->faker->randomNumber(),
            'processed_at' => $this->faker->dateTime(),
            // 'restock' => $this->faker->boolean(),
            'admin_graphql_api_id' => $this->faker->url,
        ];
    }
}
