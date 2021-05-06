<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\Product;

class LineItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LineItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'order_id' => Order::factory(),
            'variant_id' => $this->faker->randomNumber(),
            'title' => $this->faker->text(),
            'quantity' => $this->faker->randomDigit,
            'sku' => $this->faker->text(10),
            'variant_title' => $this->faker->text(),
            'vendor' => $this->faker->company,
            'fulfillment_service' => $this->faker->randomElement(['manual', 'amazon', 'shipwire']),
            'product_id' => Product::factory(),
            'requires_shipping' => $this->faker->boolean(),
            'taxable' => $this->faker->boolean(),
            'gift_card' => $this->faker->boolean(),
            'name' => $this->faker->name(),
            'variant_inventory_management' => null,
            'product_exists' => null,
            'fulfillable_quantity' => $this->faker->randomDigit,
            'grams' => $this->faker->randomDigit,
            'price' => $this->faker->randomFloat(2),
            'total_discount' => $this->faker->randomDigit,
            'fulfillment_status' => $this->faker->randomElement(['null', 'fulfilled', 'partial', 'not_eligible']),
            'price_set_id' => Money::factory(),
            'total_discount_set_id' => Money::factory(),
            'admin_graphql_api_id' => $this->faker->url,
        ];
    }
}
