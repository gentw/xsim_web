<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationalNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('national_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country', 100);
            $table->bigInteger('number');
            $table->double('setup_fee', 5, 2);
            $table->double('monthly_fee', 5, 2);
            $table->boolean('allocated')->default(0);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('national_numbers');
    }
}
