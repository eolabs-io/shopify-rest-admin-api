<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateProductsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('products', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('title');
            $table->string('body_html')->nullable();
            $table->string('vendor')->nullable();
            $table->string('product_type')->nullable();
            $table->dateTime('created_at');
            $table->string('handle')->nullable();
            $table->dateTime('updated_at');
            $table->dateTime('published_at');
            $table->string('template_suffix')->nullable();
            $table->string('status')->nullable();
            $table->string('published_scope');
            $table->string('tags')->nullable();
            $table->string('admin_graphql_api_id')->nullable();
            $table->unsignedBigInteger('image_id')->nullable();

            // $table->timestamps();
            $table->timestamp('model_created_at')->nullable();
            $table->timestamp('model_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('products');
    }
}
