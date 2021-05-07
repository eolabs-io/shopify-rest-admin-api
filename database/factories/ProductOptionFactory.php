<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\Product;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductOption;

class ProductOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductOption::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(9),
            'product_id' => Product::factory(),
            'name' => $this->faker->text(),
            'position' => $this->faker->randomElement([1,2,3,4,5]),
        ];
    }
}
