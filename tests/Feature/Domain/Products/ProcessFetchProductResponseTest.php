<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Products;

use Illuminate\Support\Arr;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\Product;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\Product as ProductModel;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Jobs\ProcessFetchProductResponse;

class ProcessFetchProductResponseTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        Product::fake();

        $results = Product::fetch();

        (new ProcessFetchProductResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_list_orders_response()
    {
        $product = ProductModel::with([
                'variants.presentmentPrices.price',
                'options.values',
                'images',
                'image',
            ])->first();

        $this->assertEquals(632910392, $product->id);
        $this->assertEquals('IPod Nano - 8GB', $product->title);
        $this->assertEquals('Apple', $product->vendor);
        $this->assertEquals('Cult Products', $product->product_type);
        $this->assertEquals('Thu Apr 01 2021 15:07:27 GMT+0000', $product->created_at->toString());
        $this->assertEquals('ipod-nano', $product->handle);
        $this->assertEquals('Thu Apr 01 2021 15:07:27 GMT+0000', $product->updated_at->toString());
        $this->assertEquals('Mon Dec 31 2007 19:00:00 GMT+0000', $product->published_at->toString());
        $this->assertNull($product->template_suffix);
        $this->assertEquals('web', $product->published_scope);
        $this->assertEquals('Emotive, Flash Memory, MP3, Music', $product->tags);
        $this->assertEquals('gid://shopify/Product/632910392', $product->admin_graphql_api_id);


        $variants = $product->variants->toArray();

        $this->assertEquals(39072856, Arr::get($variants, '0.id'));
        $this->assertEquals('Green', Arr::get($variants, '0.title'));
        $this->assertEquals(199.00, Arr::get($variants, '0.price'));
        $this->assertEquals(808950810, Arr::get($variants, '3.id'));
        $this->assertEquals('Pink', Arr::get($variants, '3.title'));
        $this->assertEquals(199.00, Arr::get($variants, '3.price'));

        // presentment_prices
        $this->assertEquals(199.00, Arr::get($variants, '0.presentment_prices.0.price.amount'));
        $this->assertEquals("USD", Arr::get($variants, '0.presentment_prices.0.price.currency_code'));

        // options
        $options = $product->options->toArray();

        $this->assertEquals(594680422, Arr::get($options, '0.id'));
        $this->assertEquals('Color', Arr::get($options, '0.name'));
        $this->assertEquals('Pink', Arr::get($options, '0.values.0.value'));

        // images
        $images = $product->images->toArray();

        $this->assertEquals(562641783, Arr::get($images, '0.id'));
        $this->assertEquals('632910392', Arr::get($images, '0.product_id'));
        $this->assertEquals('https://cdn.shopify.com/s/files/1/0006/9093/3842/products/ipod-nano-2.png?v=1617304047', Arr::get($images, '0.src'));

        // image
        $image = $product->image;

        $this->assertEquals(850703190, $image->id);
        $this->assertEquals('632910392', $image->product_id);
        $this->assertEquals('https://cdn.shopify.com/s/files/1/0006/9093/3842/products/ipod-nano.png?v=1617304047', $image->src);
    }
}
