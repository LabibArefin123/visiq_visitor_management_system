<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('office_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table->string('schedule_name');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('status');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('office_schedules');
    }
};
