<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visitor_job_applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id')->unique();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('position');
            $table->string('resume')->nullable();
            $table->string('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->date('application_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_job_applications');
    }
};
