<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_id')->unique();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('purpose');
            $table->date('visit_date');
            $table->date('date_of_birth')->nullable();
            $table->string('national_id')->nullable();
            $table->string('gender')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitors');
    }
};
