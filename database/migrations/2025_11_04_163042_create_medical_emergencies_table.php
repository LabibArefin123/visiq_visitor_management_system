<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('medical_emergencies', function (Blueprint $table) {
            $table->id();
            $table->string('incident_type');
            $table->string('reported_by_type');
            $table->unsignedBigInteger('reported_by_id');
            $table->string('location');
            $table->dateTime('incident_time');
            $table->string('status');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_emergencies');
    }
};
