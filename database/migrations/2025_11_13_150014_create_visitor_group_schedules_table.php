<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visitor_group_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_group_id')->nullable()->index();
            $table->foreignId('employee_id')->nullable()->index();
            $table->dateTime('meeting_date');
            $table->string('meeting_location')->nullable();
            $table->text('purpose')->nullable();
            $table->string('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_group_schedules');
    }
};
