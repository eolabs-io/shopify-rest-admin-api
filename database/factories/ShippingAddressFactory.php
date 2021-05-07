<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ShippingAddress;

class ShippingAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'address1' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'city' => $this->faker->city,
            'zip' => $this->faker->postcode,
            'province' => $this->faker->state,
            'country' => $this->faker->country,
            'last_name' => $this->faker->lastName,
            'address2' => $this->faker->address,
            'company' => $this->faker->company,
            'latitude' => $this->faker->latitude,
            'longitude' =>$this->faker->longitude,
            'name' => $this->faker->name(),
            'country_code' => $this->faker->countryCode,
            'province_code' => null,
        ];
    }
}
