<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelsTable extends Migration
{
    protected $table = 'travels';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 35);
			$table->datetime('start_date');
			$table->datetime('finish_date');
			$table->decimal('start_cash_balance',10,2)->default(0);
            $table->decimal('current_cash_balance',10,2)->default(0);
			$table->decimal('start_tdc_balance',10,2)->default(0);
			$table->decimal('current_tdc_balance',10,2)->default(0);
			$table->decimal('start_tdd_balance',10,2)->default(0);
			$table->decimal('current_tdd_balance',10,2)->default(0);
			$table->text('user_id', 255);
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
        Schema::dropIfExists('travels');
    }
}
