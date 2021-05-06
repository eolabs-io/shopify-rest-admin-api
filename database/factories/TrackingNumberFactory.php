<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Fulfillment;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\TrackingNumber;

class TrackingNumberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TrackingNumber::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fulfillment_id' => Fulfillment::factory(),
            'number' => $this->faker->randomNumber(),
        ];
    }
}
