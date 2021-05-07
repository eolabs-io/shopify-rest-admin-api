<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountAllocation;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;

class DiscountAllocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DiscountAllocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'line_item_id' => LineItem::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 100),
            'discount_application_index' => $this->faker->randomDigit,
            'amount_set_id' => Money::factory(),
        ];
    }
}
