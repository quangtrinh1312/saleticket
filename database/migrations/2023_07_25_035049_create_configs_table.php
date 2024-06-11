<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('link')->nullable();
            $table->string('account', 100)->nullable();
            $table->string('acpass', 50)->nullable();
            $table->string('username_api', 50)->nullable();
            $table->string('password_api', 50)->nullable();
            $table->string('pattern', 50)->nullable();
            $table->string('serial', 50)->nullable();
            $table->string('cus_name')->nullable()->default('Khách lẻ');
            $table->string('prod_name')->nullable()->default('Phí thăm quan');
            $table->string('address')->nullable()->default('Thành phố Đà Nẵng');
            $table->float('price', 20,0)->nullable()->default(20000);
            $table->string('mst')->nullable();
            $table->string('address_user')->nullable();
            $table->integer('number_max')->length(20)->nullable();
            $table->integer('number')->length(11)->nullable()->default(0);
            $table->string('api', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
