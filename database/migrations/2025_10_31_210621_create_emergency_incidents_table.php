<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('emergency_incidents', function (Blueprint $table) {
            $table->id();
            $table->string('incident_type');
            $table->text('description')->nullable();
            $table->string('reported_by')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('incident_time');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emergency_incidents');
    }
};
