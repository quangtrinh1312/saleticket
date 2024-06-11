<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address')->nullable();
            $table->string('mst')->nullable();
            $table->string('number_bill_number')->nullable();
            $table->string('number_bill_string')->nullable();
            $table->string('username')->nullable();
            $table->string('pattern', 50)->nullable();
            $table->string('serial', 50)->nullable();
            $table->string('cus_name')->nullable();
            $table->string('prod_name')->nullable();
            $table->float('price', 20,0)->nullable()->default(20000);
            $table->bigInteger('status_id')->length(11)->default(1);
            $table->bigInteger('user_id')->length(11)->default(0)->nullable();
            $table->bigInteger('ticker_group_id')->length(11)->default(0)->nullable();
            $table->bigInteger('payment_method_id')->length(11)->default(1)->nullable();
            $table->bigInteger('check')->length(11)->default(1)->nullable();
            $table->string('trading_code')->length(50)->nullable()->default('0');
            $table->softDeletes();
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
        Schema::dropIfExists('tickers');
    }
}
