<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateInventoryItemsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('inventory_items', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('sku');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->boolean('requires_shipping');
            $table->float('cost')->nullable();
            $table->string('country_code_of_origin')->nullable();
            $table->string('province_code_of_origin')->nullable();
            $table->string('harmonized_system_code')->nullable();
            $table->boolean('tracked');
            $table->string('country_harmonized_system_codes')->nullable();
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
        $this->schema->dropIfExists('inventory_items');
    }
}
