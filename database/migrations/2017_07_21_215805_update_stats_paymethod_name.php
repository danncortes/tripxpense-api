<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStatsPaymethodName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stats_paymethods_travel', function (Blueprint $table) {
            $table->string('paymethod_name', 35)->after('paymethod_tag_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stats_paymethods_travel', function (Blueprint $table) {
			$table->dropColumn('paymethod_name');
        });
    }
}
