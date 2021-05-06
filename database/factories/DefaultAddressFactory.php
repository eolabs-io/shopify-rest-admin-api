<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\DefaultAddress;

class DefaultAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DefaultAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'customer_id' => $this->faker->randomNumber(),
            'default' => $this->faker->boolean(),
            'address_id' => Address::factory(),
        ];
    }
}
