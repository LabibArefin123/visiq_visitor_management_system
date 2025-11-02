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
        Schema::create('visitor_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->nullable()->index();
            $table->foreignId('pending_visitor_id')->nullable()->index();
            $table->text('feedback_text');
            $table->tinyInteger('rating')->comment('Rating from 1 to 5');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_feedbacks');
    }
};
