<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Location;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\ProcessFetchLocationResponse;

class PerformFetchLocation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Location */
    public $location;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->location->fetch();

            ProcessFetchLocationResponse::dispatch($results);
        } catch (RequestException $exception) {
            // $delay = 30;
            // $this->handleRequestException($exception, $delay);
        }
    }
}
