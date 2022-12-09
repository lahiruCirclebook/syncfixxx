<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_employees', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('surname');
            $table->string('fullName');
            $table->string('middleName');
            $table->string('gender');
            $table->string('title');
            $table->string('maritalStatus');
            $table->string('bloodGroup');
            $table->date('dateOfBirth');
            $table->string('nationality');
            $table->integer('noOfChildren');
            $table->string('livingStatus');
            $table->string('employeeId');
            $table->string('nicNo');
            $table->string('epfNo');
            $table->string('department');
            $table->string('division');
            $table->string('designation');
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
        Schema::dropIfExists('add_employees');
    }
}
