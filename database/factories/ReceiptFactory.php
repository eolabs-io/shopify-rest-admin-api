<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Receipt;

class ReceiptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Receipt::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(9),
            'testcase' => $this->faker->boolean(),
            'authorization' => $this->faker->text(10),
        ];
    }
}
