<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateOrderAdjustmentsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('order_adjustments', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('refund_id');
            $table->float('amount');
            $table->float('tax_amount');
            $table->string('kind');
            $table->string('reason');
            $table->unsignedBigInteger('amount_set_id');
            $table->unsignedBigInteger('tax_amount_set_id');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
            $table->foreign('refund_id')->references('id')->on('refunds')->cascadeOnDelete();
            $table->foreign('amount_set_id')->references('id')->on('money')->cascadeOnDelete();
            $table->foreign('tax_amount_set_id')->references('id')->on('money')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('order_adjustments');
    }
}
