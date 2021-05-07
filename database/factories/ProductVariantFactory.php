<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\Product;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductVariant;

class ProductVariantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductVariant::class;

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
            'title' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'sku' => $this->faker->numerify('###-###-###'),
            'position' => $this->faker->randomElement([1,2,3,4,5]),
            'inventory_policy' => $this->faker->randomElement(['deny', 'continue']),
            'compare_at_price' => $this->faker->randomFloat(2, 0, 100),
            'fulfillment_service' => 'manual',
            'inventory_management' => $this->faker->randomElement(['shopify', null, 'fulfillment_service']),
            'option1' => $this->faker->randomElement(['Default Title', 'Pink', 'title']),
            'option2' => $this->faker->randomElement(['Default Title', 'Pink', 'title']),
            'option3' => $this->faker->randomElement(['Default Title', 'Pink', 'title']),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'taxable' => $this->faker->boolean(75),
            'barcode' => $this->faker->text(),
            'grams' => $this->faker->randomNumber(),
            'image_id' => null, //ProductImage::factory(),
            'weight' => $this->faker->randomNumber(),
            'weight_unit' => $this->faker->randomElement(['g', 'kg', 'oz', 'lb']),
            'inventory_item_id' => $this->faker->randomNumber(),
            'inventory_quantity' => $this->faker->randomNumber(),
            'admin_graphql_api_id' => $this->faker->url,
            'old_inventory_quantity' => null,
            'requires_shipping' => null,
        ];
    }
}
