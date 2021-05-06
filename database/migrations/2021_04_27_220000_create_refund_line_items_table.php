<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateRefundLineItemsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('refund_line_items', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('refund_id');
            $table->unsignedBigInteger('line_item_id');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('location_id');
            $table->string('restock_type');
            $table->float('subtotal');
            $table->float('total_tax');
            $table->unsignedBigInteger('subtotal_set_id');
            $table->unsignedBigInteger('total_tax_set_id');
            $table->timestamps();

            $table->foreign('refund_id')->references('id')->on('refunds')->cascadeOnDelete();
            $table->foreign('line_item_id')->references('id')->on('line_items')->cascadeOnDelete();
            $table->foreign('subtotal_set_id')->references('id')->on('money')->cascadeOnDelete();
            $table->foreign('total_tax_set_id')->references('id')->on('money')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('refund_line_items');
    }
}
