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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained(
                table: 'users', indexName: 'client_id_in_rooms'
            );
            $table->foreignId('professional_id')->constrained(
                table: 'users', indexName: 'professional_id_in_rooms'
            );
            $table->foreignId('payment_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->string('protocol');
            $table->dateTime('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('duration')->nullable();
            $table->enum('status', ['scheduled', 'in_progress', 'finished', 'canceled', 'in_dispute',]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
