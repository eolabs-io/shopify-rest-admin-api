<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateProductImagesTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('product_images', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('product_id');
            $table->integer('position');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->string('alt')->nullable();
            $table->integer('width');
            $table->integer('height');
            $table->string('src');
            $table->string('admin_graphql_api_id');
            $table->timestamp('model_created_at')->nullable();
            $table->timestamp('model_updated_at')->nullable();

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('product_images');
    }
}
