<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEligibleCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eligible_criterias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age_less_than');
            $table->integer('age_greater_than');
            $table->integer('last_login_days_ago');
            $table->float('income_less_than');
            $table->float('income_greater_than');
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
        Schema::dropIfExists('eligible_criterias');
    }
}
