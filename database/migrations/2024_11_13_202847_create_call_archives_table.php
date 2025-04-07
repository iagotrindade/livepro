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
        Schema::create('call_archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained();
            $table->foreignId('from_user_id')->constrained(
                table: 'users', indexName: 'from_user_id_in_call_archives'
            );
            $table->foreignId('to_user_id')->constrained(
                table: 'users', indexName: 'to_user_id_in_call_archives'
            );
            $table->string('name');
            $table->string('type');
            $table->string('url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_archives');
    }
};
