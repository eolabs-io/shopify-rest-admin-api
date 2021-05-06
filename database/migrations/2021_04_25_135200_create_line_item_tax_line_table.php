<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateLineItemTaxLineTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('line_item_tax_line', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('line_item_id');
            $table->unsignedBigInteger('tax_line_id');
            $table->timestamps();

            $table->foreign('line_item_id')->references('id')->on('line_items')->cascadeOnDelete();
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
        $this->schema->dropIfExists('line_item_tax_line');
    }
}
