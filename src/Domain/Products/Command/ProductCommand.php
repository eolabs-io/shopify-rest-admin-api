<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Command;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Product;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Events\FetchProduct;

class ProductCommand extends Command
{
    protected $signature = 'shopifyApi:product
                            {--ids=* : Return only products specified by list of product IDs.}
                            {--limit= : Return up to this many results per page.}
                            {--since-id= : Return only products after the specified ID.}
                            {--title= : Return products by product title.}
                            {--vendor= : Return products by vendor.}
                            {--handle=* : Return only products specified by list of product handles.}
                            {--product-type= : Return only products specified by list of product handles.}
                            {--status-any : Return only any products.}
                            {--status-active : Return only active products.}
                            {--status-archived : Return only archived products.}
                            {--status-draft : Return only draft products.}
                            {--collection-id= : Return products by product collection ID.}
                            {--created-at-min= : Return products created after a specified date.}
                            {--created-at-max= : Return products created before a specified date.}
                            {--updated-at-min= : Return products updated after a specified date.}
                            {--updated-at-max= : Return products updated before a specified date.}
                            {--published-at-min= : Return products published after a specified date.}
                            {--published-at-max= : Return products published before a specified date.}
                            {--published-status-any : Return any published products}
                            {--published-status-published : Return only published products}
                            {--published-status-unpublished : Return any unpublished products}
                            {--fields=* : Return only certain fields specified by a list of field names.}
                            {--presentment-currencies=* : Return presentment prices in only certain currencies.}';

    protected $description = 'Gets prodcuts from Shopify';


    public function handle()
    {
        $this->info('Getting Products from Shopify...');

        $product = new Product;

        $product = $this->applyOptions($product);

        FetchProduct::dispatch($product);
    }

    public function applyOptions(Product $product): Product
    {
        // Apply options
        if ($ids = $this->option('ids')) {
            $product->withProductIds($ids);
        }

        if ($limit = $this->option('limit')) {
            $product->withLimit($limit);
        }

        if ($sinceId = $this->option('since-id')) {
            $product->withSinceId($sinceId);
        }

        if ($title = $this->option('title')) {
            $product->withTitle($title);
        }

        if ($vendor = $this->option('vendor')) {
            $product->withVendor($vendor);
        }

        if ($handle = $this->option('handle')) {
            $product->withHandle($handle);
        }

        if ($productType = $this->option('product-type')) {
            $product->withProductType($productType);
        }

        if ($statusAny = $this->option('status-any')) {
            $product->withStatusAny();
        }

        if ($statusActive = $this->option('status-active')) {
            $product->withStatusActive();
        }

        if ($statusArchived = $this->option('status-archived')) {
            $product->withStatusArchived();
        }

        if ($statusDraft = $this->option('status-draft')) {
            $product->withStatusDraft($statusDraft);
        }

        if ($collectionId = $this->option('collection-id')) {
            $product->withCollectionId($collectionId);
        }

        if ($createdAtMin = $this->option('created-at-min')) {
            $product->withCreatedAtMin(Carbon::create($createdAtMin));
        }

        if ($createdAtMax = $this->option('created-at-max')) {
            $product->withCreatedAtMax(Carbon::create($createdAtMax));
        }

        if ($updatedAtMin = $this->option('updated-at-min')) {
            $product->withUpdatedAtMin(Carbon::create($updatedAtMin));
        }

        if ($updatedAtMax = $this->option('updated-at-max')) {
            $product->withUpdatedAtMax(Carbon::create($updatedAtMax));
        }

        if ($publishedAtMin = $this->option('published-at-min')) {
            $product->withPublishedAtMin(Carbon::create($publishedAtMin));
        }

        if ($publishedAtMax = $this->option('published-at-max')) {
            $product->withPublishedAtMax(Carbon::create($publishedAtMax));
        }

        if ($publishedStatusAny = $this->option('published-status-any')) {
            $product->withPublishedStatusAny();
        }

        if ($publishedStatusPublished = $this->option('published-status-published')) {
            $product->withPublishedStatusPublished();
        }

        if ($publishedStatusUnpublished = $this->option('published-status-unpublished')) {
            $product->withPublishedStatusUnpublished();
        }

        if ($fields = $this->option('fields')) {
            $product->withFields($fields);
        }

        if ($presentmentCurrencies = $this->option('presentment-currencies')) {
            $product->withPresentmentCurrencies($presentmentCurrencies);
        }

        return $product;
    }
}
