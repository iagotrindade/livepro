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
        Schema::create('professional_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professional_id')->constrained(
                table: 'users', indexName: 'professional_id_in_professional_schedules'
            );
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['available', 'scheduled', 'canceled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_schedules');
    }
};
