<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Duty;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\Price;

class DutyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Duty::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'line_item_id' => LineItem::factory(),
            'harmonized_system_code' => $this->faker->randomNumber(),
            'country_code_of_origin' => $this->faker->countryCode,
            'shop_money_id' => Price::factory(),
            'presentment_money_id' => Price::factory(),
        ];
    }
}
