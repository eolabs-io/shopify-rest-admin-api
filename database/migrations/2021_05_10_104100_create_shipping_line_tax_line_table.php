<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateShippingLineTaxLineTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('shipping_line_tax_line', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('shipping_line_id');
            $table->unsignedBigInteger('tax_line_id');
            $table->timestamps();

            $table->foreign('shipping_line_id')->references('id')->on('shipping_lines')->cascadeOnDelete();
            $table->foreign('tax_line_id')->references('id')->on('tax_lines')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('shipping_line_tax_line');
    }
}
