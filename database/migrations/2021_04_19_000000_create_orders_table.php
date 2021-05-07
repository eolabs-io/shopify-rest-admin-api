<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateOrdersTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->dateTime('closed_at')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->unsignedBigInteger('number');
            $table->string('note')->nullable();
            $table->string('token');
            $table->string('gateway')->nullable();
            $table->boolean('test');
            $table->float('total_price');
            $table->float('subtotal_price');
            $table->float('total_weight');
            $table->float('total_tax');
            $table->boolean('taxes_included');
            $table->string('currency');
            $table->string('financial_status');
            $table->boolean('confirmed');
            $table->float('total_discounts');
            $table->float('total_line_items_price');
            $table->string('cart_token')->nullable();
            $table->boolean('buyer_accepts_marketing');
            $table->string('name');
            $table->string('referring_site');
            $table->string('landing_site');
            $table->dateTime('cancelled_at')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->float('total_price_usd');
            $table->string('checkout_token');
            $table->string('reference');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->string('source_identifier');
            $table->string('source_url')->nullable();
            $table->dateTime('processed_at');
            $table->unsignedBigInteger('device_id')->nullable();
            $table->string('phone');
            $table->string('customer_locale')->nullable();
            $table->unsignedBigInteger('app_id')->nullable();
            $table->string('browser_ip');
            $table->unsignedBigInteger('client_details_id');
            $table->string('landing_site_ref');
            $table->string('order_number');
            $table->unsignedBigInteger('payment_details_id');
            $table->string('processing_method');
            $table->unsignedBigInteger('checkout_id');
            $table->string('source_name');
            $table->string('fulfillment_status')->nullable();
            $table->string('tags');
            $table->string('contact_email');
            $table->string('order_status_url');
            $table->string('presentment_currency');
            $table->unsignedBigInteger('total_line_items_price_set_id');
            $table->unsignedBigInteger('total_discounts_set_id');
            $table->unsignedBigInteger('total_shipping_price_set_id');
            $table->unsignedBigInteger('subtotal_price_set_id');
            $table->unsignedBigInteger('total_price_set_id');
            $table->unsignedBigInteger('total_tax_set_id');
            $table->float('total_tip_received');
            $table->string('admin_graphql_api_id');
            $table->unsignedBigInteger('billing_address_id');
            $table->unsignedBigInteger('shipping_address_id');
            $table->unsignedBigInteger('customer_id');

            // $table->timestamps();
            $table->timestamp('model_created_at')->nullable();
            $table->timestamp('model_updated_at')->nullable();

            $table->foreign('client_details_id')->references('id')->on('client_details')->cascadeOnDelete();
            $table->foreign('payment_details_id')->references('id')->on('payment_details')->cascadeOnDelete();
            $table->foreign('total_line_items_price_set_id')->references('id')->on('money')->cascadeOnDelete();
            $table->foreign('total_discounts_set_id')->references('id')->on('money')->cascadeOnDelete();
            $table->foreign('total_shipping_price_set_id')->references('id')->on('money')->cascadeOnDelete();
            $table->foreign('subtotal_price_set_id')->references('id')->on('money')->cascadeOnDelete();
            $table->foreign('total_price_set_id')->references('id')->on('money')->cascadeOnDelete();
            $table->foreign('total_tax_set_id')->references('id')->on('money')->cascadeOnDelete();
            $table->foreign('billing_address_id')->references('id')->on('addresses')->cascadeOnDelete();
            $table->foreign('shipping_address_id')->references('id')->on('addresses')->cascadeOnDelete();
            // $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('orders');
    }
}
