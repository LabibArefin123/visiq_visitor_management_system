<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('ai_chat_message', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id');
            $table->text('chat_content');
            $table->dateTime('chat_date');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('ai_chat_message');
    }
};
