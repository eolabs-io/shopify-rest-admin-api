<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateCustomersTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('email')->nullable();
            $table->boolean('accepts_marketing');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('orders_count');
            $table->string('state');
            $table->float('total_spent');
            $table->string('last_order_id')->nullable();
            $table->string('note')->nullable();
            $table->boolean('verified_email');
            $table->string('multipass_identifier')->nullable();
            $table->boolean('tax_exempt');
            $table->string('phone')->nullable();
            $table->string('tags');
            $table->string('last_order_name')->nullable();
            $table->string('currency');
            $table->dateTime('accepts_marketing_updated_at');
            $table->string('marketing_opt_in_level')->nullable();
            $table->string('admin_graphql_api_id');
            $table->unsignedBigInteger('default_address_id')->nullable();

            // $table->timestamps();
            $table->timestamp('model_created_at')->nullable();
            $table->timestamp('model_updated_at')->nullable();

            // $table->foreign('default_address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('customers');
    }
}
