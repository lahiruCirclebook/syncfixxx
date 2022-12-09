<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_productions', function (Blueprint $table) {
            $table->id();
            $table->string('dailyProductionId');
            $table->string('unit');
            $table->date('date');
            $table->string('supervisorId');
            $table->integer('presentEmployees');
            $table->integer('absentEmployees');
            $table->integer('totalProduction');
            $table->integer('damageCount');
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
        Schema::dropIfExists('daily_productions');
    }
}
