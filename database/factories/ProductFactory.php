<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\Product;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductImage;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(9),
            'title' => $this->faker->text(),
            'body_html' => $this->faker->text(),
            'vendor' => $this->faker->company,
            'product_type' => $this->faker->text(),
            'created_at' => $this->faker->dateTime(),
            'handle' => $this->faker->text(),
            'updated_at' => $this->faker->dateTime(),
            'published_at' => $this->faker->dateTime(),
            'template_suffix' => $this->faker->text(),
            'status' => $this->faker->text(),
            'published_scope' => $this->faker->text(),
            'tags' => $this->faker->text(),
            'admin_graphql_api_id' => $this->faker->url,
            'image_id' => null, //ProductImage::factory(),
        ];
    }
}
