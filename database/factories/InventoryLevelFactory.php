<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryLevel;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\Location;

class InventoryLevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryLevel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'inventory_item_id' => InventoryItem::factory(),
            'location_id' => Location::factory(),
            'available' => $this->faker->randomNumber(),
            'updated_at' => $this->faker->dateTime(),
            'admin_graphql_api_id' => $this->faker->url,
        ];
    }
}
