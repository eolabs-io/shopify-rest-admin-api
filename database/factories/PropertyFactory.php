<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Property;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'line_item_id' => LineItem::factory(),
            'name' => $this->faker->text(),
            'value' => $this->faker->text(),
        ];
    }
}
