<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\Price;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductVariant;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\PresentmentPrice;

class PresentmentPriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PresentmentPrice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_variant_id' => ProductVariant::factory(),
            'price_id' => Price::factory(),
            'compare_at_price_id' => Price::factory(),
        ];
    }
}
