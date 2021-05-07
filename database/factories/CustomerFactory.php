<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Customer;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(9),
            'email' => $this->faker->email,
            'accepts_marketing' => $this->faker->boolean(95),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName,
            'orders_count' => $this->faker->randomDigit,
            'state' => $this->faker->state,
            'total_spent' => $this->faker->randomFloat(2, 0, 100),
            'last_order_id' => $this->faker->randomNumber(),
            'note' => $this->faker->text(),
            'verified_email' => $this->faker->boolean(),
            'multipass_identifier' => null,
            'tax_exempt' => $this->faker->boolean(),
            'phone' => $this->faker->phoneNumber,
            'tags' => $this->faker->text(),
            'last_order_name' => $this->faker->text(),
            'currency' => $this->faker->currencyCode,
            'accepts_marketing_updated_at' => $this->faker->dateTime(),
            'marketing_opt_in_level' => null,
            'admin_graphql_api_id' => $this->faker->url,
            'default_address_id' => null, //Address::factory(),
        ];
    }
}
