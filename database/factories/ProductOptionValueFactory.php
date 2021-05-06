<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductOption;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductOptionValue;

class ProductOptionValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductOptionValue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_option_id'  => ProductOption::factory(),
            'value' => $this->faker->text(),
        ];
    }
}
