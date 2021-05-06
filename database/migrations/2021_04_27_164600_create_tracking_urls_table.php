<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateTrackingUrlsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('tracking_urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fulfillment_id');
            $table->string('url');
            $table->timestamps();

            $table->foreign('fulfillment_id')->references('id')->on('fulfillments')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('tracking_urls');
    }
}
