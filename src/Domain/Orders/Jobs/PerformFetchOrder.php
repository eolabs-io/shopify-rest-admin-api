<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Events\FetchOrder;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\ShopifyThrottlingMiddleware;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Jobs\ProcessFetchOrderResponse;

class PerformFetchOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Orders\Order */
    public $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->order->fetch();

            ProcessFetchOrderResponse::dispatch($results);
            FetchOrder::dispatchIf($this->order->hasNextPage(), $this->order);
        } catch (RequestException $exception) {
            // $delay = 30;
            // $this->handleRequestException($exception, $delay);
        }
    }

    public function middleware()
    {
        return [ShopifyThrottlingMiddleware::forShopify()];
    }
}
