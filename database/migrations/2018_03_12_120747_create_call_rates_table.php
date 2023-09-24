<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('carrier')->nullable();
            $table->string('country')->nullable();
            $table->string('operator')->nullable();
            $table->string('network_type')->nullable();
            $table->string('network')->nullable();
            $table->string('abbreviation')->nullable();
            $table->string('code')->nullable();
            $table->string('link_1')->nullable();
            $table->string('link_2')->nullable();
            $table->string('link_3')->nullable();
            $table->boolean('gprs')->default(0)->nullable();
            $table->boolean('3g')->default(0)->nullable();
            $table->boolean('preferred')->default(0)->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->double('sms_in_rate', 6, 2)->nullable();
            $table->double('sms_out_rate', 6, 2)->nullable();
            $table->double('xxsim_sms_rate', 6, 2)->nullable();
            $table->smallInteger('zone', false, true)->length(2)->nullable();
            $table->double('zone_rate', 6, 2)->nullable();
            $table->double('gprs_rate', 6, 2)->nullable();
            $table->double('call_in_rate', 6, 2)->nullable();
            $table->double('call_out_rate', 6, 2)->nullable();
            $table->double('extra_rate', 6, 2)->nullable();
            $table->double('xxsim_call_rate', 6, 2)->nullable();
            $table->double('call_xxsim_to_xxsim', 6, 2)->nullable();
            $table->double('sms_xxsim_to_xxsim', 6, 2)->nullable();
            $table->double('voicemail', 6, 2)->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('call_rates');
    }
}
