<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assign_point_guards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('access_point_id');
            $table->foreignId('guard_id');
            $table->time('shift_start')->nullable();
            $table->time('shift_end')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assign_point_guards');
    }
};
