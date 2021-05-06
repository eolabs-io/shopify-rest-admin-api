<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateRefundDutiesTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('refund_duties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('duty_id');
            $table->unsignedBigInteger('refund_id');
            $table->string('refund_type');
            $table->timestamps();

            $table->foreign('refund_id')->references('id')->on('refunds')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('refund_duties');
    }
}
