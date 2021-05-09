<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Product;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\ShopifyThrottlingMiddleware;

class PerformFetchProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var olabsIo\ShopifyRestAdminApi\Domain\Products\Product */
    public $product;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->product->fetch();

            ProcessFetchProductResponse::dispatch($results);
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
