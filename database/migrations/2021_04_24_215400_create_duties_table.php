<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateDutiesTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('duties', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('line_item_id');
            $table->string('harmonized_system_code');
            $table->string('country_code_of_origin');
            $table->unsignedBigInteger('shop_money_id');
            $table->unsignedBigInteger('presentment_money_id');
            $table->timestamps();

            $table->foreign('line_item_id')->references('id')->on('line_items')->cascadeOnDelete();
            $table->foreign('shop_money_id')->references('id')->on('prices');
            $table->foreign('presentment_money_id')->references('id')->on('prices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('duties');
    }
}
