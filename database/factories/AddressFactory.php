<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Customer;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(9),
            'customer_id' => Customer::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company' => $this->faker->company,
            'address1' => $this->faker->address,
            'address2' => $this->faker->address,
            'city' => $this->faker->city,
            'province' => $this->faker->state,
            'country' => $this->faker->country,
            'zip' => $this->faker->postcode,
            'phone' => $this->faker->phoneNumber,
            'name' => $this->faker->name(),
            'province_code' => null,
            'country_code' => $this->faker->countryCode,
            'country_name' => $this->faker->country,
            'default' => $this->faker->boolean,
        ];
    }
}
