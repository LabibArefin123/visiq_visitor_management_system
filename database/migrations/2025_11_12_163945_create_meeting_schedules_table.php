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
        Schema::create('meeting_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_schedule_id')->nullable()->index();
            $table->string('title');
            $table->date('meeting_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('description')->nullable();
            $table->string('meeting_type');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_schedules');
    }
};
