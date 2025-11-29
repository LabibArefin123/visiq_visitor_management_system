<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visitor_host_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id');
            $table->foreignId('employee_id');
            $table->dateTime('meeting_date');
            $table->string('meeting_location')->nullable();
            $table->text('purpose')->nullable();
            $table->string('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_host_schedules');
    }
};
