<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('overstay_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id');
            $table->string('visitor_name');
            $table->date('visit_date');
            $table->date('expected_checkout_date');
            $table->date('actual_checkout_date')->nullable();
            $table->string('status');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('overstay_alerts');
    }
};
