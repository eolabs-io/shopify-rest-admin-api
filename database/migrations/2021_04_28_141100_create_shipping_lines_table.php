<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateShippingLinesTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('shipping_lines', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('order_id');
            $table->string('code');
            $table->float('price');
            $table->unsignedBigInteger('price_set_id');
            $table->float('discounted_price');
            $table->unsignedBigInteger('discounted_price_set_id');
            $table->string('source');
            $table->string('title');
            $table->string('carrier_identifier')->nullable();
            $table->string('requested_fulfillment_service_id')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
            $table->foreign('price_set_id')->references('id')->on('money')->cascadeOnDelete();
            $table->foreign('discounted_price_set_id')->references('id')->on('money')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('shipping_lines');
    }
}
