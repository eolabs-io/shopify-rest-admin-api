<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateDiscountAllocationsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('discount_allocations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('line_item_id');
            $table->string('amount');
            $table->string('discount_application_index');
            $table->unsignedBigInteger('amount_set_id');
            $table->timestamps();

            $table->foreign('amount_set_id')->references('id')->on('money');
            $table->foreign('line_item_id')->references('id')->on('line_items')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('discount_allocations');
    }
}
