<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateDutyRefundTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('duty_refund', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('duty_id');
            $table->unsignedBigInteger('refund_id');
            $table->timestamps();

            $table->foreign('duty_id')->references('id')->on('duties')->cascadeOnDelete();
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
        $this->schema->dropIfExists('duty_refund');
    }
}
