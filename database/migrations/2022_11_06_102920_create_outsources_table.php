<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutsourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outsources', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('workerName');
            $table->string('workerId');
            $table->date('date');
            $table->string('umbrellaCode');
            $table->integer('coverAmount');
            $table->integer('frameAmount');
            $table->integer('threadAmount');
            $table->integer('expectedUmbrella');
            $table->integer('rejectedUmbrella');
            $table->boolean('isActive');
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
        Schema::dropIfExists('outsources');
    }
}
