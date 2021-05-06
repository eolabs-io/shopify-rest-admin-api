<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateDutyTaxLineTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('duty_tax_line', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('duty_id');
            $table->unsignedBigInteger('tax_line_id');
            $table->timestamps();

            $table->foreign('duty_id')->references('id')->on('duties')->cascadeOnDelete();
            $table->foreign('tax_line_id')->references('id')->on('tax_lines')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('duty_tax_line');
    }
}
