<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsPaymethodsTravel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats_paymethods_travel', function (Blueprint $table) {
            $table->increments('id');
			$table->text('user_id', 255);
			$table->integer('travel_id')->unsigned();
			$table->integer('paymethod_id')->unsigned();
            $table->string('paymethod_tag_name', 35);
			$table->decimal('spent',10,2)->default(0);
			$table->decimal('income',10,2)->default(0);
			$table->bigInteger('operations')->default(0);
            $table->timestamps();

            $table->foreign('travel_id')->references('id')->on('travels')->onDelete('cascade');
            $table->foreign('paymethod_id')->references('id')->on('pay_methods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats_paymethods_travel');
    }
}
