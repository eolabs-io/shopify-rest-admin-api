<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateLineItemsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('line_items', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('variant_id');
            $table->string('title');
            $table->unsignedBigInteger('quantity');
            $table->string('sku');
            $table->string('variant_title')->nullable();
            $table->string('vendor')->nullable();
            $table->string('fulfillment_service');
            $table->unsignedBigInteger('product_id');
            $table->boolean('requires_shipping');
            $table->boolean('taxable');
            $table->boolean('gift_card');
            $table->string('name');
            $table->string('variant_inventory_management')->nullable();
            $table->boolean('product_exists')->nullable();
            $table->unsignedBigInteger('fulfillable_quantity');
            $table->float('grams');
            $table->float('price');
            $table->float('total_discount');
            $table->string('fulfillment_status')->nullable();
            $table->unsignedBigInteger('price_set_id');
            $table->unsignedBigInteger('total_discount_set_id');
            $table->string('admin_graphql_api_id');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            // $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('price_set_id')->references('id')->on('money');
            $table->foreign('total_discount_set_id')->references('id')->on('money');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('line_items');
    }
}
