<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 40);
            $table->text('description');
            $table->decimal('cost',6,2);
            $table->date('date_op');
            $table->string('type')->default('outcome');
            $table->integer('cod_method')->unsigned();
            $table->integer('cod_travel')->unsigned();
            $table->integer('cod_category')->unsigned();
            $table->text('user_id', 255);

            $table->foreign('cod_method')->references('id')->on('pay_methods')->onDelete('cascade');
            $table->foreign('cod_travel')->references('id')->on('travels')->onDelete('cascade');
            $table->foreign('cod_category')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('operations');
    }
}
