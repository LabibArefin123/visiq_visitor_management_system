<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pending_visitors', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_id');
            $table->string('national_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('purpose');
            $table->date('visit_date');
            $table->date('date_of_birth');
            $table->string('status');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pending_visitors');
    }
};
