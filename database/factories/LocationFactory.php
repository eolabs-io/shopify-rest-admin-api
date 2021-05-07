<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\Location;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(9),
            'name' => $this->faker->name,
            'address1' => $this->faker->address,
            'address2' => null,
            'city' => $this->faker->city,
            'zip' => $this->faker->postcode,
            'province' => $this->faker->state,
            'country' => $this->faker->country,
            'phone' => $this->faker->phoneNumber,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'country_code' => $this->faker->countryCode,
            'country_name' => $this->faker->country,
            'province_code' => $this->faker->state,
            'legacy' => $this->faker->boolean(),
            'active' => $this->faker->boolean(),
            'admin_graphql_api_id' => $this->faker->url,
        ];
    }
}
