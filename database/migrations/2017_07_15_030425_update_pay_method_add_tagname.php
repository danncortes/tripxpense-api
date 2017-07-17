<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePayMethodAddTagname extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_methods', function (Blueprint $table) {
			$table->string('tag_name', 35)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pay_methods', function (Blueprint $table) {
			$table->dropColumn('tag_name');
        });
    }
}
