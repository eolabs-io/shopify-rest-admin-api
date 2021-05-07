<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\CurrencyExchangeAdjustment;

class CurrencyExchangeAdjustmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CurrencyExchangeAdjustment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(9),
            'adjustment' => $this->faker->randomFloat(2, 0, 100),
            'original_amount' => $this->faker->randomFloat(2, 0, 100),
            'final_amount' => $this->faker->randomFloat(2, 0, 100),
            'currency' => $this->faker->currencyCode,
        ];
    }
}
