<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Jobs\ProcessFetchOrderResponse;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order as OrderModel;

class ProcessFetchOrderResponseTest extends TestCase
{
    use RefreshDatabase;

    public $results;

    protected function setUp(): void
    {
        parent::setUp();

        Order::fake();

        $this->results = Order::fetch();

        (new ProcessFetchOrderResponse($this->results))->handle();
    }

    /** @test */
    public function it_can_process_list_orders_response()
    {
        $order = OrderModel::with([
                'clientDetails',
                'paymentDetails',
                'totalLineItemsPriceSet',
                'totalDiscountsSet',
                'totalShippingPriceSet',
                'subtotalPriceSet',
                'totalPriceSet',
                'totalTaxSet',
                'billingAddress',
                'shippingAddress',
                'customer',
                'discountApplications',
                'discountCodes',
                'noteAttributes',
                'paymentGatewayNames',
                'taxLines',
                'lineItems',
                'fulfillments',
                'refunds',
                'shippingLines',
            ])->first();

        $this->assertEquals(450789469, $order->id);
        $this->assertEquals('bob.norman@hostmail.com', $order->email);
        $this->assertNull($order->closed_at);
        $this->assertEquals('Thu Jan 10 2008 11:00:00 GMT+0000', $order->created_at->toString());
        $this->assertEquals('Thu Jan 10 2008 11:00:00 GMT+0000', $order->updated_at->toString());
        $this->assertEquals(1, $order->number);
        $this->assertNull($order->note);
        $this->assertEquals('b1946ac92492d2347c6235b4d2611184', $order->token);

        // Relationships
        $this->assertClientDetails($order);
        $this->assertPaymentDetails($order);
        $this->assertTotalLineItemsPriceSet($order);
        $this->assertTotalDiscountsSet($order);
        $this->assertTotalShippingPriceSet($order);
        $this->assertSubtotalPriceSet($order);
        $this->assertTotalPriceSet($order);
        $this->assertTotalTaxSet($order);
        $this->assertBillingAddress($order);
        $this->assertShippingAddress($order);
        $this->assertCustomer($order);
        $this->assertDiscountApplications($order);
        $this->assertDiscountCodes($order);
        $this->assertNoteAttributes($order);
        $this->assertPaymentGatewayNames($order);
        $this->assertTaxLines($order);
        $this->assertLineItems($order);
        $this->assertFulfillments($order);
        $this->assertRefunds($order);
        $this->assertShippingLines($order);
    }

    /** @test */
    public function it_can_process_same_order_without_duplication_response()
    {
        $this->assertOrderDataBaseState();

        // Same repsonse as before processed a second time
        (new ProcessFetchOrderResponse($this->results))->handle();

        $this->assertOrderDataBaseState();
    }

    public function assertOrderDataBaseState()
    {
        $this->assertDatabaseCount('locations', 0);
        $this->assertDatabaseCount('inventory_items', 0);
        $this->assertDatabaseCount('inventory_levels', 0);
        $this->assertDatabaseCount('products', 0);
        $this->assertDatabaseCount('prices', 48);
        $this->assertDatabaseCount('product_images', 0);
        $this->assertDatabaseCount('product_variants', 0);
        $this->assertDatabaseCount('product_options', 0);
        $this->assertDatabaseCount('product_option_values', 0);
        $this->assertDatabaseCount('presentment_prices', 0);
        $this->assertDatabaseCount('addresses', 0);
        $this->assertDatabaseCount('billing_addresses', 1);
        $this->assertDatabaseCount('shipping_addresses', 1);
        $this->assertDatabaseCount('customers', 0);
        $this->assertDatabaseCount('tax_exemptions', 0);
        $this->assertDatabaseCount('customer_tax_exemption', 0);
        $this->assertDatabaseCount('money', 24);
        $this->assertDatabaseCount('payment_details', 1);
        $this->assertDatabaseCount('client_details', 1);
        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseCount('discount_applications', 1);
        $this->assertDatabaseCount('discount_codes', 1);
        $this->assertDatabaseCount('note_attributes', 2);
        $this->assertDatabaseCount('payment_gateway_names', 1);
        $this->assertDatabaseCount('tax_lines', 3);
        $this->assertDatabaseCount('line_items', 3);
        $this->assertDatabaseCount('discount_allocations', 3);
        $this->assertDatabaseCount('duties', 0);
        $this->assertDatabaseCount('duty_tax_line', 0);
        $this->assertDatabaseCount('properties', 2);
        $this->assertDatabaseCount('line_item_tax_line', 3);
        $this->assertDatabaseCount('fulfillments', 1);
        $this->assertDatabaseCount('receipts', 1);
        $this->assertDatabaseCount('fulfillment_line_item', 1);
        $this->assertDatabaseCount('tracking_numbers', 1);
        $this->assertDatabaseCount('tracking_urls', 1);
        $this->assertDatabaseCount('refunds', 1);
        $this->assertDatabaseCount('refund_duties', 0);
        $this->assertDatabaseCount('refund_line_items', 2);
        $this->assertDatabaseCount('order_adjustments', 1);
        $this->assertDatabaseCount('currency_exchange_adjustments', 0);
        $this->assertDatabaseCount('transactions', 1);
        $this->assertDatabaseCount('duty_refund', 0);
        $this->assertDatabaseCount('refund_transaction', 1);
        $this->assertDatabaseCount('shipping_lines', 1);
        $this->assertDatabaseCount('order_tax_line', 1);
    }

    public function assertClientDetails($order)
    {
        $clientDetails = $order->clientDetails;

        $this->assertEquals(1, $clientDetails->id);
        $this->assertNull($clientDetails->accept_language);
        $this->assertNull($clientDetails->browser_height);
        $this->assertEquals('0.0.0.0', $clientDetails->browser_ip);
        $this->assertNull($clientDetails->browser_width);
        $this->assertNull($clientDetails->session_hash);
    }

    public function assertPaymentDetails($order)
    {
        $paymentDetails = $order->paymentDetails;

        $this->assertEquals(1, $paymentDetails->id);
        $this->assertNull($paymentDetails->avs_result_code);
        $this->assertNull($paymentDetails->cvv_result_code);
        $this->assertEquals("•••• •••• •••• 4242", $paymentDetails->credit_card_number);
        $this->assertNull($paymentDetails->credit_card_name);
        $this->assertNull($paymentDetails->credit_card_wallet);
    }

    public function assertTotalLineItemsPriceSet($order)
    {
        $totalLineItemsPriceSet = $order->totalLineItemsPriceSet;
        $shopMoney = $totalLineItemsPriceSet->shopMoney;
        $this->assertEquals('USD', $shopMoney->currency_code);
        $this->assertEquals(597.00, $shopMoney->amount);

        $presentmentMoney = $totalLineItemsPriceSet->presentmentMoney;
        $this->assertEquals('USD', $presentmentMoney->currency_code);
        $this->assertEquals(597.11, $presentmentMoney->amount);
    }

    public function assertTotalDiscountsSet($order)
    {
        $totalDiscountsSet = $order->totalDiscountsSet;
        $shopMoney = $totalDiscountsSet->shopMoney;
        $this->assertEquals('USD', $shopMoney->currency_code);
        $this->assertEquals(10.00, $shopMoney->amount);

        $presentmentMoney = $totalDiscountsSet->presentmentMoney;
        $this->assertEquals('USD', $presentmentMoney->currency_code);
        $this->assertEquals(10.00, $presentmentMoney->amount);
    }

    public function assertTotalShippingPriceSet($order)
    {
        $totalShippingPriceSet = $order->totalShippingPriceSet;
        $shopMoney = $totalShippingPriceSet->shopMoney;
        $this->assertEquals('USD', $shopMoney->currency_code);
        $this->assertEquals(0.00, $shopMoney->amount);

        $presentmentMoney = $totalShippingPriceSet->presentmentMoney;
        $this->assertEquals('USD', $presentmentMoney->currency_code);
        $this->assertEquals(0.00, $presentmentMoney->amount);
    }

    public function assertSubtotalPriceSet($order)
    {
        $subtotalPriceSet = $order->subtotalPriceSet;
        $shopMoney = $subtotalPriceSet->shopMoney;
        $this->assertEquals('USD', $shopMoney->currency_code);
        $this->assertEquals(597.0, $shopMoney->amount);

        $presentmentMoney = $subtotalPriceSet->presentmentMoney;
        $this->assertEquals('USD', $presentmentMoney->currency_code);
        $this->assertEquals(597.0, $presentmentMoney->amount);
    }

    public function assertTotalPriceSet($order)
    {
        $totalPriceSet = $order->totalPriceSet;
        $shopMoney = $totalPriceSet->shopMoney;
        $this->assertEquals('USD', $shopMoney->currency_code);
        $this->assertEquals(598.94, $shopMoney->amount);

        $presentmentMoney = $totalPriceSet->presentmentMoney;
        $this->assertEquals('USD', $presentmentMoney->currency_code);
        $this->assertEquals(598.94, $presentmentMoney->amount);
    }

    public function assertTotalTaxSet($order)
    {
        $totalTaxSet = $order->totalTaxSet;
        $shopMoney = $totalTaxSet->shopMoney;
        $this->assertEquals('USD', $shopMoney->currency_code);
        $this->assertEquals(11.94, $shopMoney->amount);

        $presentmentMoney = $totalTaxSet->presentmentMoney;
        $this->assertEquals('USD', $presentmentMoney->currency_code);
        $this->assertEquals(11.94, $presentmentMoney->amount);
    }

    public function assertBillingAddress($order)
    {
        $address = $order->billingAddress;

        $this->assertEquals('Bob', $address->first_name);
        $this->assertEquals('Chestnut Street 92', $address->address1);
        $this->assertEquals('555-625-1199', $address->phone);
    }

    public function assertShippingAddress($order)
    {
        $address = $order->shippingAddress;

        $this->assertEquals('Bob', $address->first_name);
        $this->assertEquals('Chestnut Street 92', $address->address1);
        $this->assertEquals('555-625-1199', $address->phone);
    }

    public function assertCustomer($order)
    {
        $this->assertEquals(207119551, $order->customer_id);
    }

    public function assertDiscountApplications($order)
    {
        $discountApplication = $order->discountApplications->first();

        $this->assertEquals('450789469', $discountApplication->order_id);
        $this->assertEquals('discount_code', $discountApplication->type);
        $this->assertEquals(10, $discountApplication->value);
        $this->assertEquals('fixed_amount', $discountApplication->value_type);
        $this->assertEquals('across', $discountApplication->allocation_method);
    }

    public function assertDiscountCodes($order)
    {
        $discountCode = $order->discountCodes->first();

        $this->assertEquals('TENOFF', $discountCode->code);
        $this->assertEquals('10.00', $discountCode->amount);
        $this->assertEquals('fixed_amount', $discountCode->type);
    }

    public function assertNoteAttributes($order)
    {
        $noteAttribute = $order->noteAttributes->first();

        $this->assertEquals('custom engraving', $noteAttribute->name);
        $this->assertEquals('Happy Birthday', $noteAttribute->value);
    }

    public function assertPaymentGatewayNames($order)
    {
        $paymentGatewayName = $order->paymentGatewayNames->first();
        $this->assertEquals('bogus', $paymentGatewayName->name);
    }

    public function assertTaxLines($order)
    {
        $taxLine = $order->taxLines->first();

        $this->assertEquals('11.94', $taxLine->price);
        $this->assertEquals(0.06, $taxLine->rate);
        $this->assertEquals('State Tax', $taxLine->title);

        $this->assertEquals(11.94, $taxLine->priceSet->shopMoney->amount);
        $this->assertEquals('USD', $taxLine->priceSet->presentmentMoney->currency_code);
    }

    public function assertLineItems($order)
    {
        $lineItem = $order->lineItems->first();

        $this->assertEquals(466157049, $lineItem->id);
        $this->assertEquals(39072856, $lineItem->variant_id);
        $this->assertEquals('IPOD2008GREEN', $lineItem->sku);

        $priceSet = $lineItem->priceSet;
        $this->assertEquals(199.00, $priceSet->shopMoney->amount);
        $this->assertEquals('USD', $priceSet->shopMoney->currency_code);

        $totalDiscountSet = $lineItem->totalDiscountSet;
        $this->assertEquals(0.00, $totalDiscountSet->shopMoney->amount);
        $this->assertEquals('USD', $totalDiscountSet->shopMoney->currency_code);

        $property = $lineItem->properties->first();
        $this->assertEquals('Custom Engraving Front', $property->name);
        $this->assertEquals('Happy Birthday', $property->value);

        $discountAllocation = $lineItem->discountAllocations->first();
        $this->assertEquals('3.34', $discountAllocation->amount);
        $this->assertEquals(0, $discountAllocation->discount_application_index);
    }

    public function assertFulfillments($order)
    {
        $fulfillment = $order->fulfillments->first();

        $this->assertEquals(255858046, $fulfillment->id);
        $this->assertEquals(450789469, $fulfillment->order_id);
        $this->assertEquals('failure', $fulfillment->status);

        $lineItem = $order->lineItems->first();
        $this->assertEquals(466157049, $lineItem->id);
        $this->assertEquals(39072856, $lineItem->variant_id);
    }

    public function assertRefunds($order)
    {
        $refund = $order->refunds->first();

        $this->assertEquals(509562969, $refund->id);
        $this->assertEquals(450789469, $refund->order_id);
        $this->assertEquals(799407056, $refund->user_id);

        $refundLineItem = $refund->refundLineItems->first();
        $this->assertEquals(104689539, $refundLineItem->id);
        $this->assertEquals(1, $refundLineItem->quantity);
        $this->assertEquals(703073504, $refundLineItem->line_item_id);
    }

    public function assertShippingLines($order)
    {
        $shippingLine = $order->shippingLines->first();

        $this->assertEquals(369256396, $shippingLine->id);
        $this->assertEquals('Free Shipping', $shippingLine->title);
        $this->assertEquals(0.00, $shippingLine->price);
    }
}
