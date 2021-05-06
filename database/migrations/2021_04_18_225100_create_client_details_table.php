<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Migrations\ShopifyMigration;

class CreateClientDetailsTable extends ShopifyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('client_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('accept_language')->nullable();
            $table->string('browser_height')->nullable();
            $table->string('browser_ip')->nullable();
            $table->string('browser_width')->nullable();
            $table->string('session_hash')->nullable();
            $table->string('user_agent')->nullable();
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
        $this->schema->dropIfExists('client_details');
    }
}
