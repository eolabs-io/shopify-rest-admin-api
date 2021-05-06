<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateRefundTransactionTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('refund_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('refund_id');
            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions')->cascadeOnDelete();
            $table->foreign('refund_id')->references('id')->on('refunds')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('refund_transaction');
    }
}
