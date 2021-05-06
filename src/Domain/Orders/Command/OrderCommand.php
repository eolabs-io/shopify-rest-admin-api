<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Command;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Events\FetchOrder;

class OrderCommand extends Command
{
    protected $signature = 'shopifyApi:order
                            {--ids=* : Return only orders specified by list of order IDs.}
                            {--limit= : Return up to this many results per page.}
                            {--since-id= : Return only orders after the specified ID.}
                            {--created-at-min= : Return orders created after a specified date.}
                            {--created-at-max= : Return orders created before a specified date.}
                            {--updated-at-min= : Return orders updated after a specified date.}
                            {--updated-at-max= : Return orders updated before a specified date.}
                            {--processed-at-min= : Return orders processed after a specified date.}
                            {--processed-at-max= : Return orders processed before a specified date.}
                            {--attribution-app-id= : Show orders attributed to a certain app.}
                            {--status-any : Show orders of any status.}
                            {--status-open : Show orders of open status.}
                            {--status-closed : Show orders of closed status.}
                            {--status-cancelled : Show orders of cancelled status.}
                            {--financial-status-any : Show orders of any financial status.}
                            {--financial-status-authorized : Show orders of authorized financial status.}
                            {--financial-status-pending : Show orders of pending financial status.}
                            {--financial-status-paid : Show orders of paid financial status.}
                            {--financial-status-partially-paid : Show orders of partially paid financial status.}
                            {--financial-status-refunded : Show orders of refunded financial status.}
                            {--financial-status-voided : Show orders of voided financial status.}
                            {--financial-status-partially-refunded : Show orders of partially refunded financial status.}
                            {--financial-status-unpaid : Show orders of unpaid financial status.}
                            {--fulfillment-status-any : Show orders of any fulfillment status.}
                            {--fulfillment-status-shipped : Show orders of shipped  fulfillment status.}
                            {--fulfillment-status-partial : Show orders of partial fulfillment status.}
                            {--fulfillment-status-unshipped : Show orders of unshipped fulfillment status.}
                            {--fulfillment-status-unfulfilled : Show orders of unfulfilled fulfillment status.}
                            {--fields=* : Return only certain fields specified by a list of field names.}';


    protected $description = 'Gets orders from Shopify';


    public function handle()
    {
        $this->info('Getting Orders from Shopify...');

        $order = new Order;

        $order = $this->applyOptions($order);

        FetchOrder::dispatch($order);
    }

    public function applyOptions(Order $order): Order
    {
        // Apply options
        if ($ids = $this->option('ids')) {
            $order->withOrderIds($ids);
        }

        if ($limit = $this->option('limit')) {
            $order->withLimit($limit);
        }

        if ($sinceId = $this->option('since-id')) {
            $order->withSinceId($sinceId);
        }

        if ($createdAtMin = $this->option('created-at-min')) {
            $order->withCreatedAtMin(Carbon::create($createdAtMin));
        }

        if ($createdAtMax = $this->option('created-at-max')) {
            $order->withCreatedAtMax(Carbon::create($createdAtMax));
        }

        if ($updatedAtMin = $this->option('updated-at-min')) {
            $order->withUpdatedAtMin(Carbon::create($updatedAtMin));
        }

        if ($updatedAtMax = $this->option('updated-at-max')) {
            $order->withUpdatedAtMax(Carbon::create($updatedAtMax));
        }

        if ($processedAtMin = $this->option('processed-at-min')) {
            $order->withProcessedAtMin(Carbon::create($processedAtMin));
        }

        if ($processedAtMax = $this->option('processed-at-max')) {
            $order->withProcessedAtMax(Carbon::create($processedAtMax));
        }

        if ($attributionAppId = $this->option('attribution-app-id')) {
            $order->withAttributionAppId($attributionAppId);
        }

        if ($statusAny = $this->option('status-any')) {
            $order->withStatusAny();
        }

        if ($statusOpen = $this->option('status-open')) {
            $order->withStatusOpen();
        }

        if ($statusClosed = $this->option('status-closed')) {
            $order->withStatusClosed();
        }

        if ($statusCancelled = $this->option('status-cancelled')) {
            $order->withStatusCancelled();
        }

        if ($financialStatusAny = $this->option('financial-status-any')) {
            $order->withFinancialStatusAny();
        }

        if ($financialStatusAuthorized = $this->option('financial-status-authorized')) {
            $order->withFinancialStatusAuthorized();
        }

        if ($financialStatusPending = $this->option('financial-status-pending')) {
            $order->withFinancialStatusPending();
        }

        if ($financialStatusPaid = $this->option('financial-status-paid')) {
            $order->withFinancialStatusPaid();
        }

        if ($financialStatusPartiallyPaid = $this->option('financial-status-partially-paid')) {
            $order->withFinancialStatusPartiallyPaid();
        }

        if ($financialStatusRefunded = $this->option('financial-status-refunded')) {
            $order->withFinancialStatusRefunded();
        }

        if ($financialStatusVoided = $this->option('financial-status-voided')) {
            $order->withFinancialStatusVoided();
        }

        if ($financialStatusPartiallyRefunded = $this->option('financial-status-partially-refunded')) {
            $order->withFinancialStatusPartiallyRefunded();
        }

        if ($financialStatusUnpaid = $this->option('financial-status-unpaid')) {
            $order->withFinancialStatusUnpaid();
        }

        if ($fulfillmentStatusAny = $this->option('fulfillment-status-any')) {
            $order->withFulfillmentStatusAny();
        }

        if ($fulfillmentStatusShipped = $this->option('fulfillment-status-shipped')) {
            $order->withFulfillmentStatusShipped();
        }

        if ($fulfillmentStatusPartial = $this->option('fulfillment-status-partial')) {
            $order->withFulfillmentStatusPartial();
        }

        if ($fulfillmentStatusUnshipped = $this->option('fulfillment-status-unshipped')) {
            $order->withFulfillmentStatusUnshipped();
        }

        if ($fulfillmentStatusUnfulfilled = $this->option('fulfillment-status-unfulfilled')) {
            $order->withFulfillmentStatusUnfulfilled();
        }

        if ($fields = $this->option('fields')) {
            $order->withFields($fields);
        }

        return $order;
    }
}
