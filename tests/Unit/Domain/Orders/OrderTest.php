<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Refund;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\TaxLine;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountCode;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ClientDetails;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\NoteAttribute;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\PaymentDetails;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\PaymentGatewayName;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountApplication;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ShippingLine;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Fulfillment;

class OrderTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Order::class;
    }

    /** @test */
    public function it_has_client_details_relationship()
    {
        $expectedClientDetails = ClientDetails::factory()->create();
        Order::factory()->create(['client_details_id' => $expectedClientDetails->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedClientDetails->toArray(), $actualOrder->clientDetails->toArray());
    }

    /** @test */
    public function it_has_payment_details_relationship()
    {
        $expectedPaymentDetails = PaymentDetails::factory()->create();
        Order::factory()->create(['payment_details_id' => $expectedPaymentDetails->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedPaymentDetails->toArray(), $actualOrder->paymentDetails->toArray());
    }

    /** @test */
    public function it_has_total_line_items_price_set_relationship()
    {
        $expectedMoney = Money::factory()->create();
        Order::factory()->create(['total_line_items_price_set_id' => $expectedMoney->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedMoney->toArray(), $actualOrder->totalLineItemsPriceSet->toArray());
    }

    /** @test */
    public function it_has_total_discounts_set_relationship()
    {
        $expectedMoney = Money::factory()->create();
        Order::factory()->create(['total_discounts_set_id' => $expectedMoney->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedMoney->toArray(), $actualOrder->totalDiscountsSet->toArray());
    }

    /** @test */
    public function it_has_total_shipping_price_set_relationship()
    {
        $expectedMoney = Money::factory()->create();
        Order::factory()->create(['total_shipping_price_set_id' => $expectedMoney->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedMoney->toArray(), $actualOrder->totalShippingPriceSet->toArray());
    }

    /** @test */
    public function it_has_subtotal_price_set_relationship()
    {
        $expectedMoney = Money::factory()->create();
        Order::factory()->create(['subtotal_price_set_id' => $expectedMoney->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedMoney->toArray(), $actualOrder->subtotalPriceSet->toArray());
    }

    /** @test */
    public function it_has_total_price_set_relationship()
    {
        $expectedMoney = Money::factory()->create();
        Order::factory()->create(['total_price_set_id' => $expectedMoney->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedMoney->toArray(), $actualOrder->totalPriceSet->toArray());
    }

    /** @test */
    public function it_has_total_tax_set_relationship()
    {
        $expectedMoney = Money::factory()->create();
        Order::factory()->create(['total_tax_set_id' => $expectedMoney->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedMoney->toArray(), $actualOrder->totalTaxSet->toArray());
    }

    /** @test */
    public function it_has_billing_address_relationship()
    {
        $expectedAddress = Address::factory()->create();
        Order::factory()->create(['billing_address_id' => $expectedAddress->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedAddress->toArray(), $actualOrder->billingAddress->toArray());
    }

    /** @test */
    public function it_has_shipping_address_relationship()
    {
        $expectedAddress = Address::factory()->create();
        Order::factory()->create(['shipping_address_id' => $expectedAddress->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedAddress->toArray(), $actualOrder->shippingAddress->toArray());
    }

    // HasMany //

    /** @test */
    public function it_has_discount_applications_relationship()
    {
        $order = Order::factory()->create();
        $expectedDiscountApplications = DiscountApplication::factory()->times(3)->create(['order_id' => $order->id]);

        $actualOrder = Order::first();

        $this->assertEquals($expectedDiscountApplications->toArray(), $actualOrder->discountApplications->toArray());
    }

    /** @test */
    public function it_has_discount_codes_relationship()
    {
        $order = Order::factory()->create();
        $expectedDiscountCodes = DiscountCode::factory()->times(3)->create(['order_id' => $order->id]);

        $actualOrder = Order::first();

        $this->assertEquals($expectedDiscountCodes->toArray(), $actualOrder->discountcodes->toArray());
    }

    /** @test */
    public function it_has_note_attributes_relationship()
    {
        $order = Order::factory()->create();
        $expectedNoteAttributes = NoteAttribute::factory()->times(3)->create(['order_id' => $order->id]);

        $actualOrder = Order::first();

        $this->assertEquals($expectedNoteAttributes->toArray(), $actualOrder->noteAttributes->toArray());
    }

    /** @test */
    public function it_has_payment_gateway_names_relationship()
    {
        $order = Order::factory()->create();
        $expectedPaymentGatewayNames = PaymentGatewayName::factory()->times(3)->create(['order_id' => $order->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedPaymentGatewayNames->toArray(), $actualOrder->paymentGatewayNames->toArray());
    }

    /** @test */
    public function it_has_tax_lines_relationship()
    {
        $expectedTaxLines = TaxLine::factory()->times(3)->create();
        $order = Order::factory()->create();
        $order->taxLines()->attach($expectedTaxLines);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedTaxLines->toArray(), $actualOrder->taxLines->toArray());
    }

    /** @test */
    public function it_has_line_items_relationship()
    {
        $order = Order::factory()->create();
        $expectedLineItems = LineItem::factory()->times(3)->create(['order_id' => $order->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedLineItems->toArray(), $actualOrder->lineItems->toArray());
    }

    /** @test */
    public function it_has_fulfillments_relationship()
    {
        $order = Order::factory()->create();
        $expectedFulfillments = Fulfillment::factory()->times(3)->create(['order_id' => $order->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedFulfillments->toArray(), $actualOrder->fulfillments->toArray());
    }

    /** @test */
    public function it_has_refunds_relationship()
    {
        $order = Order::factory()->create();
        $expectedRefunds = Refund::factory()->times(3)->create(['order_id' => $order->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedRefunds->toArray(), $actualOrder->refunds->toArray());
    }

    /** @test */
    public function it_has_shipping_lines_relationship()
    {
        $order = Order::factory()->create();
        $expectedShippingLines = ShippingLine::factory()->times(3)->create(['order_id' => $order->id]);

        $actualOrder = Order::first();

        $this->assertArraysEqual($expectedShippingLines->toArray(), $actualOrder->shippingLines->toArray());
    }
}
