<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTypeInEligibleCriterias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eligible_criterias', function (Blueprint $table) {
            $table->bigInteger('income_less_than')->change();
            $table->bigInteger('income_greater_than')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eligible_criterias', function (Blueprint $table) {
            $table->bigInteger('income_less_than')->change();
            $table->bigInteger('income_greater_than')->change();
        });
    }
}
