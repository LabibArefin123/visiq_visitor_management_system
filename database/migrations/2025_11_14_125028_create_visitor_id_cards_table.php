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
        Schema::create('visitor_id_cards', function (Blueprint $table) {
            $table->id();
            $table->string('card_number')->unique();
            $table->string('holder_type'); // 'employee', 'visitor', 'guard'
            $table->unsignedBigInteger('holder_id'); // References ID of the holder
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('status')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_id_cards');
    }
};
