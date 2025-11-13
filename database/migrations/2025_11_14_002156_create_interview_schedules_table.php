<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interview_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->nullable()->index();
            $table->foreignId('employee_id')->nullable()->index();
            $table->dateTime('interview_date');
            $table->string('position');
            $table->string('status');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interview_schedules');
    }
};
