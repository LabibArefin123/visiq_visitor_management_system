<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pending_visitors', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_id');
            $table->string('national_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('purpose');
            $table->date('visit_date');
            $table->date('date_of_birth')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pending_visitors');
    }
};
