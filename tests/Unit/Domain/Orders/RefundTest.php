<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Duty;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\OrderAdjustment;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Refund;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\RefundDuty;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Transaction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\RefundLineItem;

class RefundTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Refund::class;
    }

    /** @test */
    public function it_has_order_relationship()
    {
        $expectedOrder = Order::factory()->create();
        Refund::factory()->create(['order_id' => $expectedOrder->id]);

        $actualRefund = Refund::first();

        $this->assertArraysEqual($expectedOrder->toArray(), $actualRefund->order->toArray());
    }

    /** @test */
    public function it_has_duties_relationship()
    {
        $expectedDuties = Duty::factory()->times(3)->create();

        $refund = Refund::factory()->create();
        $refund->duties()->attach($expectedDuties);

        $actualRefund = Refund::first();

        $this->assertArraysEqual($expectedDuties->toArray(), $actualRefund->duties->toArray());
    }

    /** @test */
    public function it_has_refund_duties_relationship()
    {
        $refund = Refund::factory()->create();
        $expectedRefundDuties = RefundDuty::factory()->times(3)->create(['refund_id' => $refund->id]);

        $actualRefund = Refund::first();

        $this->assertArraysEqual($expectedRefundDuties->toArray(), $actualRefund->refundDuties->toArray());
    }

    /** @test */
    public function it_has_refund_line_items_relationship()
    {
        $refund = Refund::factory()->create();
        $expectedRefundLineItems = RefundLineItem::factory()->times(3)->create(['refund_id' => $refund->id]);

        $actualRefund = Refund::first();

        $this->assertArraysEqual($expectedRefundLineItems->toArray(), $actualRefund->refundLineItems->toArray());
    }

    /** @test */
    public function it_has_transactions_relationship()
    {
        $expectedTransactions = Transaction::factory()->times(3)->create();

        $refund = Refund::factory()->create();
        $refund->transactions()->attach($expectedTransactions);

        $actualRefund = Refund::first();

        $this->assertArraysEqual($expectedTransactions->toArray(), $actualRefund->transactions->toArray());
    }

    /** @test */
    public function it_has_order_adjustments_relationship()
    {
        $refund = Refund::factory()->create();
        $expectedOrderAdjustments = OrderAdjustment::factory()->times(3)->create(['refund_id' => $refund->id]);

        $actualRefund = Refund::first();

        $this->assertArraysEqual($expectedOrderAdjustments->toArray(), $actualRefund->orderAdjustments->toArray());
    }
}
