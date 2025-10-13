<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesCheckOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_check_out', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->string('name');
            $table->integer('age');
            $table->string('department');
            $table->time('check_out_time');
            $table->time('expected_check_out_time');
            $table->string('status');
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
        Schema::dropIfExists('employees_check_out');
    }
}
