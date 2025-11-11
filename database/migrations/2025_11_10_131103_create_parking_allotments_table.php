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
        Schema::create('parking_allotments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_category_id')->nullable()->index();
            $table->foreignId('area_id')->nullable()->index();
            $table->foreignId('building_location_id')->nullable()->index();
            $table->foreignId('building_list_id')->nullable()->index();
            $table->foreignId('parking_location_id')->nullable()->index();
            $table->foreignId('parking_list_id')->nullable()->index();
            $table->string('alloted_by')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('parking_allotments');
    }
};
