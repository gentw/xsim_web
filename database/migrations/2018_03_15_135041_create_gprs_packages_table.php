<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGprsPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gprs_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('zone_id')->unsigned();
            $table->integer('code', false)->length('2');
            $table->integer('duration', false)->length('3');
            $table->integer('data', false)->length('7');
            $table->double('price', 5, 2);
            $table->timestamps();

            $table->foreign('zone_id')->references('id')->on('zones')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gprs_packages');
    }
}
