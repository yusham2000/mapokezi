<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('case_name');
            $table->string('case_number');
            $table->string('room');
            $table->time('hearing_time');
            $table->date('service_date');
            $table->unsignedInteger('queue_number');
            $table->string('status')->default('waiting');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['service_date', 'queue_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_schedules');
    }
};
