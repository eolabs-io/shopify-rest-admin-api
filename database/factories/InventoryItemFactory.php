<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryItem;

class InventoryItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'sku' => Str::random(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'requires_shipping' => $this->faker->boolean(),
            'cost' => $this->faker->randomFloat(2),
            'country_code_of_origin' => $this->faker->countryCode,
            'province_code_of_origin' => $this->faker->state,
            'harmonized_system_code' => $this->faker->text(),
            'tracked' => $this->faker->boolean(),
            'country_harmonized_system_codes' => $this->faker->text(),
            'admin_graphql_api_id' => $this->faker->url,
        ];
    }
}
