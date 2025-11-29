<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('chat_ai_data', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id');
            $table->text('chat_content');
            $table->dateTime('chat_date');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('chat_ai_data');
    }
};
