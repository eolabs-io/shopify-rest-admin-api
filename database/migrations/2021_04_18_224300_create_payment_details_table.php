<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreatePaymentDetailsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('payment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('credit_card_bin')->nullable();
            $table->string('avs_result_code')->nullable();
            $table->string('cvv_result_code')->nullable();
            $table->string('credit_card_number')->nullable();
            $table->string('credit_card_company')->nullable();
            $table->string('credit_card_name')->nullable();
            $table->string('credit_card_wallet')->nullable();
            $table->string('credit_card_expiration_month')->nullable();
            $table->string('credit_card_expiration_year')->nullable();
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
        $this->schema->dropIfExists('payment_details');
    }
}
