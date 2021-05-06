<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateTaxLinesTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('tax_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('price');
            $table->float('rate');
            $table->string('title')->nullable();
            $table->unsignedBigInteger('price_set_id');
            $table->timestamps();

            $table->foreign('price_set_id')->references('id')->on('money')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('tax_lines');
    }
}
