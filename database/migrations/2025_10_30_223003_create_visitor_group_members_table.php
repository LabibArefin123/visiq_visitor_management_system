<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_group_members', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->json('visitor_ids'); // Store multiple visitors in one group
            $table->integer('total_group_members')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_group_members');
    }
};
