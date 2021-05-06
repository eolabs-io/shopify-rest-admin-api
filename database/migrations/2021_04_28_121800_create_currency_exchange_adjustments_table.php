<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateCurrencyExchangeAdjustmentsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('currency_exchange_adjustments', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->float('adjustment');
            $table->float('original_amount');
            $table->float('final_amount');
            $table->string('currency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('currency_exchange_adjustments');
    }
}
