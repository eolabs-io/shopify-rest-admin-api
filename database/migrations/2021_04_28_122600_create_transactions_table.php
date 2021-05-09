<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateTransactionsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('order_id');
            $table->string('kind');
            $table->string('gateway');
            $table->string('status');
            $table->string('message')->nullable();
            $table->dateTime('created_at');
            $table->boolean('test');
            $table->string('authorization')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('parent_id');
            $table->dateTime('processed_at');
            $table->unsignedBigInteger('device_id')->nullable();
            $table->string('error_code')->nullable();
            $table->string('source_name');
            $table->unsignedBigInteger('receipt_id')->nullable();
            $table->unsignedBigInteger('currency_exchange_adjustment_id')->nullable();
            $table->float('amount');
            $table->string('currency');
            $table->string('admin_graphql_api_id');
            $table->unsignedBigInteger('payment_details_id')->nullable();

            // $table->timestamps();
            $table->timestamp('model_created_at')->nullable();
            $table->timestamp('model_updated_at')->nullable();

            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
            $table->foreign('receipt_id')->references('id')->on('receipts')->cascadeOnDelete();
            $table->foreign('currency_exchange_adjustment_id')->references('id')->on('currency_exchange_adjustments')->cascadeOnDelete();
            $table->foreign('payment_details_id')->references('id')->on('payment_details')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('transactions');
    }
}
