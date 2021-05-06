<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateProductVariantsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('product_variants', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('product_id');
            $table->string('title');
            $table->float('price')->nullable();
            $table->string('sku')->nullable();
            $table->integer('position');
            $table->string('inventory_policy');
            $table->float('compare_at_price')->nullable();
            $table->string('fulfillment_service');
            $table->string('inventory_management')->nullable();
            $table->string('old_inventory_quantity')->nullable();
            $table->string('requires_shipping')->nullable();
            $table->string('option1')->nullable();
            $table->string('option2')->nullable();
            $table->string('option3')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->boolean('taxable');
            $table->string('barcode')->nullable();
            $table->integer('grams');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->integer('weight');
            $table->string('weight_unit');
            $table->unsignedBigInteger('inventory_item_id');
            $table->unsignedBigInteger('inventory_quantity');
            $table->string('admin_graphql_api_id')->nullable();

            // $table->timestamps();
            $table->timestamp('model_created_at')->nullable();
            $table->timestamp('model_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('product_variants');
    }
}
