<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateFulfillmentLineItemTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('fulfillment_line_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fulfillment_id');
            $table->unsignedBigInteger('line_item_id');
            $table->timestamps();

            $table->foreign('fulfillment_id')->references('id')->on('fulfillments')->cascadeOnDelete();
            $table->foreign('line_item_id')->references('id')->on('line_items')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('fulfillment_line_item');
    }
}
