<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\Product;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductImage;

class ProductImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'product_id' => Product::factory(),
            'position' => $this->faker->randomElement([1,2,3,4,5,6]),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'alt' => $this->faker->text(),
            'width' => $this->faker->randomNumber(),
            'height' => $this->faker->randomNumber(),
            'src' => $this->faker->url,
            // 'variant_ids',
            'admin_graphql_api_id' => $this->faker->url,
        ];
    }
}
