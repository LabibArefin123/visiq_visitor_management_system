<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('visitor_emergency', function (Blueprint $table) {
            $table->id();
            $table->string('emergency_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->text('reason');
            $table->dateTime('emergency_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitor_emergency');
    }
};
