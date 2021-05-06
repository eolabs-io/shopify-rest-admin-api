<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\ShippingFulfillment;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Receipt;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Fulfillment;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\TrackingUrl;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\TrackingNumber;

class FulfillmentTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Fulfillment::class;
    }

    /** @test */
    public function it_has_line_items_relationship()
    {
        $lineItems = LineItem::factory()->times(3)->create();

        $fulfillment = Fulfillment::factory()->create();
        $fulfillment->lineItems()->attach($lineItems);

        $fulfillment = Fulfillment::with([
            'lineItems',
        ])->first();

        $this->assertEquals($lineItems->toArray(), $fulfillment->lineItems->toArray());
    }

    /** @test */
    public function it_has_receipts_relationship()
    {
        $receipt = Receipt::factory()->create();
        $fulfillment = Fulfillment::factory()->create(['receipt_id' => $receipt->id]);

        $fulfillment = Fulfillment::with([
                'receipt',
        ])->first();

        $this->assertEquals($receipt->toArray(), $fulfillment->receipt->toArray());
    }

    /** @test */
    public function it_has_tracking_numbers_relationship()
    {
        $fulfillment = Fulfillment::factory()->create();
        $trackingNumbers = TrackingNumber::factory()->times(3)->create(['fulfillment_id' => $fulfillment->id]);

        $fulfillment = Fulfillment::with([
                    'trackingNumbers',
                ])->first();

        $this->assertEquals($trackingNumbers->toArray(), $fulfillment->trackingNumbers->toArray());
    }

    /** @test */
    public function it_has_tracking_urls_relationship()
    {
        $fulfillment = Fulfillment::factory()->create();
        $trackingUrls = TrackingUrl::factory()->times(3)->create(['fulfillment_id' => $fulfillment->id]);

        $fulfillment = Fulfillment::with([
                        'trackingUrls',
                    ])->first();

        $this->assertEquals($trackingUrls->toArray(), $fulfillment->trackingUrls->toArray());
    }
}
