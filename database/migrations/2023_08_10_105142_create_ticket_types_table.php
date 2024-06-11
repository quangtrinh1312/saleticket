<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->float('post_vat_price')->nullable();
            $table->float('pre_vat_price')->nullable();
            $table->float('vat')->nullable()->default(null);
            $table->string('note')->nullable();
            $table->string('pattern')->nullable();
            $table->string('serial')->nullable();
            $table->boolean('is_actived')->default(true);
            $table->string('duration')->nullable();
            $table->string('expired')->nullable();
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
        Schema::dropIfExists('ticket_types');
    }
}
