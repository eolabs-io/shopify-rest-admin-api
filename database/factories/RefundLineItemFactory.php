<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Refund;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\RefundLineItem;

class RefundLineItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RefundLineItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(9),
            'refund_id' => Refund::factory(),
            'line_item_id' => LineItem::factory(),
            'quantity' => $this->faker->randomNumber(),
            'location_id' => $this->faker->randomNumber(),
            'restock_type' => $this->faker->randomElement([
                'no_restock',
                'cancel',
                'return',
                'legacy_restock',
            ]),
            'subtotal' => $this->faker->randomFloat(2, 0, 100),
            'total_tax' => $this->faker->randomFloat(2, 0, 100),
            'subtotal_set_id' => Money::factory(),
            'total_tax_set_id' => Money::factory(),
        ];
    }
}
