<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReloadDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reload_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_transaction_id')->unsigned()->nullable();
            $table->string('number', 50);
            $table->double('amount');
            $table->date('validity');
            $table->string('transaction_id');
            $table->timestamps();

            $table->foreign('payment_transaction_id')->references('id')->on('payment_transactions')
                    ->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reload_data');
    }
}
