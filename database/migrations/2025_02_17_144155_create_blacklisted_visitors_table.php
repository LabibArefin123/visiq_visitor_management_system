<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlacklistedVisitorsTable extends Migration
{
    public function up()
    {
        Schema::create('blacklisted_visitors', function (Blueprint $table) {
            $table->id(); // Automatically creates an 'id' column
            $table->string('blacklist_id')->nullable(); // The B_id field (you can modify this if it needs to be unique)
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('reason');
            $table->string('national_id')->nullable();
            $table->timestamp('blacklisted_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blacklisted_visitors');
    }
}
