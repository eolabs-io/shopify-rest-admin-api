<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreatePresentmentPricesTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('presentment_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_variant_id');
            $table->unsignedBigInteger('price_id');
            $table->unsignedBigInteger('compare_at_price_id')->nullable();
            $table->timestamps();

            $table->foreign('product_variant_id')->references('id')->on('product_variants')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('price_id')->references('id')->on('prices')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('compare_at_price_id')->references('id')->on('prices')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('presentment_prices');
    }
}
