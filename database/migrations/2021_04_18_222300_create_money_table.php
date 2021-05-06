<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateMoneyTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('money', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('shop_money_id');
            $table->unsignedBigInteger('presentment_money_id');
            $table->timestamps();

            $table->foreign('shop_money_id')->references('id')->on('prices')->cascadeOnDelete();
            $table->foreign('presentment_money_id')->references('id')->on('prices')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('money');
    }
}
