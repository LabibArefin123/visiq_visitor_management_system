<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seat_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_category_id')->nullable()->index();
            $table->foreignId('room_list_id')->nullable()->index();
            $table->foreignId('employee_id')->nullable()->index();
            $table->foreignId('visitor_id')->nullable()->index();
            $table->string('seat_number')->unique();
            $table->date('allocation_date');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seat_allocations');
    }
};
