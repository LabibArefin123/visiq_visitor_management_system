<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evacuation_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->date('scheduled_date');
            $table->time('scheduled_time')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evacuation_plans');
    }
};
