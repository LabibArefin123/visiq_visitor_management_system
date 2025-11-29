<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lost_and_founds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id');
            $table->string('item_name');
            $table->string('status');
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->date('reported_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lost_and_founds');
    }
};
