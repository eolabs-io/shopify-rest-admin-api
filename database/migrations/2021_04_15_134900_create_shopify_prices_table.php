<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateShopifyPricesTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency_code');
            $table->float('amount');
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
        $this->schema->dropIfExists('prices');
    }
}
