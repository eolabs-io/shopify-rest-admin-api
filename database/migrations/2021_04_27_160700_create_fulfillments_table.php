<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateFulfillmentsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('fulfillments', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('order_id');
            $table->string('status');
            $table->dateTime('created_at');
            $table->string('service');
            $table->dateTime('updated_at');
            $table->string('tracking_company');
            $table->string('shipment_status')->nullable();
            $table->unsignedBigInteger('location_id');
            $table->string('tracking_number');
            $table->string('tracking_url');
            $table->unsignedBigInteger('receipt_id')->nullable();
            $table->string('name');
            $table->string('admin_graphql_api_id');
            $table->boolean('notify_customer')->nullable();
            $table->string('variant_inventory_management')->nullable();

            // $table->timestamps();
            $table->timestamp('model_created_at')->nullable();
            $table->timestamp('model_updated_at')->nullable();

            $table->foreign('receipt_id')->references('id')->on('receipts')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('fulfillments');
    }
}
