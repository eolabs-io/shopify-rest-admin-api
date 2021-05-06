<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Receipt;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Fulfillment;

class FulfillmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fulfillment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'order_id' => Order::factory(),
            'status' => $this->faker->randomElement([
                'pending',
                'open',
                'success',
                'cancelled',
                'error',
                'failure',
            ]),
            'created_at' => $this->faker->dateTime(),
            'service' => 'manual',
            'updated_at' => $this->faker->dateTime(),
            'tracking_company' => $this->faker->randomElement([
                '4PX',
                'Amazon Logistics UK',
                'Amazon Logistics US',
                'Anjun Logistics',
                'APC',
                'Australia Post',
                'Bluedart',
                'Canada Post',
                'Canpar',
                'China Post',
                'Chukou1',
                'Correios',
                'Couriers Please',
                'Delhivery',
                'DHL eCommerce',
                'DHL eCommerce Asia',
                'DHL Express',
                'DPD',
                'DPD Local',
                'DPD UK',
                'Eagle',
                'FedEx',
                'FSC',
                'Globegistics',
                'GLS',
                'GLS (US)',
                'Japan Post',
                'La Poste',
                'New Zealand Post',
                'Newgistics',
                'PostNL',
                'PostNord',
                'Purolator',
                'Royal Mail',
                'Sagawa',
                'Sendle',
                'SF Express',
                'SFC Fulfilllment',
                'Singapore Post',
                'StarTrack',
                'TNT',
                'Toll IPEC',
                'UPS',
                'USPS',
                'Whistl',
                'Yamato',
                'YunExpress',
            ]),
            'shipment_status' => $this->faker->randomElement([
                'label_printed',
                'label_purchased',
                'attempted_delivery',
                'ready_for_pickup',
                'confirmed',
                'in_transit',
                'out_for_delivery',
                'delivered',
                'failure',
            ]),
            'location_id' => $this->faker->randomNumber(),
            'tracking_number' => $this->faker->randomNumber(),
            'tracking_url' => $this->faker->url,
            'receipt_id' => Receipt::factory(),
            'name' => $this->faker->name,
            'admin_graphql_api_id' => $this->faker->url,
            'notify_customer' => $this->faker->boolean(),
            'variant_inventory_management' => 'shopify',
        ];
    }
}
