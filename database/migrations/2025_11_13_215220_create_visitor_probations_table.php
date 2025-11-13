<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visitor_probations', function (Blueprint $table) {
            $table->id();
            $table->string('probation_id')->unique();
            $table->string('name');
            $table->string('phone');
            $table->string('reason')->nullable();
            $table->string('status'); // pending | approved | cancelled
            $table->string('national_id')->nullable();
            $table->timestamp('probation_start')->nullable();
            $table->timestamp('probation_end')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_probations');
    }
};
