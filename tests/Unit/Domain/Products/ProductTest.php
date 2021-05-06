<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Products;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\Product;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductImage;

class ProductTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Product::class;
    }

    /** @test */
    public function it_has_variants_relationship()
    {
        Product::factory()->hasVariants()->create();

        $this->assertDatabaseCount('product_variants', 1);
        $this->assertEquals(1, Product::first()->variants()->count());
    }

    /** @test */
    public function it_has_options_relationship()
    {
        Product::factory()->hasOptions()->create();

        $this->assertDatabaseCount('product_options', 1);
        $this->assertEquals(1, Product::first()->options()->count());
    }

    /** @test */
    public function it_has_images_relationship()
    {
        $product = Product::factory()->create();
        ProductImage::factory()->times(3)->create(['product_id' => $product->id]);

        $this->assertDatabaseCount('product_images', 3);
        $this->assertEquals(3, Product::find($product->id)->images()->count());
    }

    /** @test */
    public function it_has_image_relationship()
    {
        $image = ProductImage::factory()->create();

        $product = Product::factory()->create([
            'image_id' => $image->id,
        ]);

        $this->assertDatabaseCount('product_images', 1);
        $this->assertEquals(1, Product::find($product->id)->image()->count());
    }
}
