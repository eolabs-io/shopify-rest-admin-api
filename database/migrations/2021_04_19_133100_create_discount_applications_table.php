<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateDiscountApplicationsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('discount_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->string('type')->nullable();
            $table->string('value')->nullable();
            $table->string('value_type')->nullable();
            $table->string('allocation_method')->nullable();
            $table->string('target_selection')->nullable();
            $table->string('target_type')->nullable();
            $table->string('code')->nullable();
            $table->timestamps();

            // $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('discount_applications');
    }
}
