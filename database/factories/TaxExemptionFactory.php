<?php

namespace EolabsIo\ShopifyRestAdminApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\TaxExemption;

class TaxExemptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaxExemption::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'EXEMPT_ALL',
                'CA_STATUS_CARD_EXEMPTION',
                'CA_DIPLOMAT_EXEMPTION',
                'CA_BC_RESELLER_EXEMPTION',
                'CA_MB_RESELLER_EXEMPTION',
                'CA_SK_RESELLER_EXEMPTION',
                'CA_BC_COMMERCIAL_FISHERY_EXEMPTION',
                'CA_MB_COMMERCIAL_FISHERY_EXEMPTION',
                'CA_NS_COMMERCIAL_FISHERY_EXEMPTION',
                'CA_PE_COMMERCIAL_FISHERY_EXEMPTION',
                'CA_SK_COMMERCIAL_FISHERY_EXEMPTION',
                'CA_BC_PRODUCTION_AND_MACHINERY_EXEMPTION',
                'CA_SK_PRODUCTION_AND_MACHINERY_EXEMPTION',
                'CA_BC_SUB_CONTRACTOR_EXEMPTION',
                'CA_SK_SUB_CONTRACTOR_EXEMPTION',
                'CA_BC_CONTRACTOR_EXEMPTION',
                'CA_SK_CONTRACTOR_EXEMPTION',
                'CA_ON_PURCHASE_EXEMPTION',
                'CA_MB_FARMER_EXEMPTION',
                'CA_NS_FARMER_EXEMPTION',
                'CA_SK_FARMER_EXEMPTION',
            ]),
        ];
    }
}
