<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemDamagesTable extends Migration
{
    public function up(): void
    {
        Schema::create('item_damages', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('item_name_in_bangla')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('reported_by')->nullable();
            $table->text('remarks')->nullable();
            $table->date('damage_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_damages');
    }
}
