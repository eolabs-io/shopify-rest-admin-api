<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ClientDetails;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\PaymentDetails;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

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
            'closed_at' => $this->faker->dateTime(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'number' => $this->faker->randomNumber(),
            'note' => $this->faker->text(),
            'token' => $this->faker->text(),
            'gateway' => 'shopify_payments',
            'test' => $this->faker->boolean(),
            'total_price' => $this->faker->randomFloat(2, 0, 100),
            'subtotal_price' => $this->faker->randomFloat(2, 0, 100),
            'total_weight' => $this->faker->randomFloat(2, 0, 100),
            'total_tax' => $this->faker->randomFloat(2, 0, 100),
            'taxes_included' => $this->faker->boolean(),
            'currency' => $this->faker->currencyCode,
            'financial_status' => $this->faker->randomElement([
                'pending',
                'authorized',
                'partially_paid',
                'paid',
                'partially_refunded',
                'refunded',
                'voided',
            ]),
            'confirmed' => $this->faker->boolean(),
            'total_discounts' => $this->faker->randomFloat(2, 0, 100),
            'total_line_items_price' => $this->faker->randomFloat(2, 0, 100),
            'cart_token' => $this->faker->text(),
            'buyer_accepts_marketing' => $this->faker->boolean(),
            'name' => $this->faker->name(),
            'referring_site' => $this->faker->text(),
            'landing_site' => $this->faker->url,
            'cancelled_at' => $this->faker->dateTime(),
            'cancel_reason' => $this->faker->randomElement([
                'customer',
                'fraud',
                'inventory',
                'declined',
                'other',
            ]),
            'total_price_usd' => $this->faker->randomFloat(2, 0, 100),
            'checkout_token' => $this->faker->text(),
            'reference' => $this->faker->text(),
            'user_id' => $this->faker->randomNumber(),
            'location_id' => $this->faker->randomNumber(),
            'source_identifier' => $this->faker->text(),
            'source_url' => $this->faker->url,
            'processed_at' => $this->faker->dateTime(),
            'device_id' => $this->faker->randomNumber(),
            'phone' => $this->faker->phoneNumber,
            'customer_locale' => $this->faker->text(),
            'app_id' => $this->faker->randomNumber(),
            'browser_ip' => $this->faker->ipv4,
            'client_details_id' => ClientDetails::factory(),
            'landing_site_ref' => $this->faker->text(),
            'order_number' => '#'.$this->faker->numerify('#####'),
            'payment_details_id' => PaymentDetails::factory(),
            'processing_method' => $this->faker->randomElement([
                'checkout',
                'direct',
                'manual',
                'offsite',
                'express',
                'free',
            ]),
            'checkout_id' => $this->faker->randomNumber(),
            'source_name' => $this->faker->text(),
            'fulfillment_status' => $this->faker->randomElement([
                'fulfilled',
                'null',
                'partial',
                'restocked',
            ]),
            'tags' => 'imported',
            'contact_email' => $this->faker->email,
            'order_status_url' => $this->faker->url,
            'presentment_currency' => $this->faker->currencyCode,
            'total_line_items_price_set_id' => Money::factory(),
            'total_discounts_set_id' => Money::factory(),
            'total_shipping_price_set_id' => Money::factory(),
            'subtotal_price_set_id' => Money::factory(),
            'total_price_set_id' => Money::factory(),
            'total_tax_set_id' => Money::factory(),
            'total_tip_received' => $this->faker->randomFloat(2, 0, 100),
            'admin_graphql_api_id' => $this->faker->url,
            'billing_address_id' => Address::factory(),
            'shipping_address_id' => Address::factory(),
            'customer_id' => $this->faker->randomNumber(),
        ];
    }
}
