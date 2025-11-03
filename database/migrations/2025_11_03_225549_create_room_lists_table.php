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
        Schema::create('room_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_category_id')->nullable()->index();
            $table->foreignId('area_id')->nullable()->index();
            $table->foreignId('building_location_id')->nullable()->index();
            $table->foreignId('building_list_id')->nullable()->index();
            $table->string('room_name');
            $table->string('room_name_in_bangla')->nullable();
            $table->integer('level')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_lists');
    }
};
