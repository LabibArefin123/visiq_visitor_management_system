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
        Schema::create('access_history_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assign_point_guard_id');
            $table->date('log_date');
            $table->time('accessed_at')->nullable();
            $table->time('left_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_history_logs');
    }
};
