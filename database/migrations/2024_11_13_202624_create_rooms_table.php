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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->nullable()->constrained();
            $table->string('room_id');
            $table->foreignId('recording_id')->nullable()->constrained();
            $table->string('name');
            $table->string('url');
            $table->dateTime('start_time');
            $table->dateTime('expires_at');
            $table->enum('status', ['scheduled', 'paid', 'refunded', 'in_progress', 'finished']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
