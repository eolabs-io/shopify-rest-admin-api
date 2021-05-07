<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreatePropertiesTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('line_item_id');
            $table->string('name');
            $table->string('value');
            $table->timestamps();

            $table->foreign('line_item_id')->references('id')->on('line_items')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('properties');
    }
}
