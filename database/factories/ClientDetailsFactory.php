<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ClientDetails;

class ClientDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'accept_language' => null,
            'browser_height' => null,
            'browser_ip' => '0.0.0.0',
            'browser_width' => null,
            'session_hash' => null,
            'user_agent' => null,
        ];
    }
}
