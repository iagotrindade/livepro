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
        Schema::create('professional_occupations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professional_id')->constrained(
                table: 'users', indexName: 'professional_id_for_ocupations'
            );
            $table->foreignId('occupation_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_ocupations');
    }
};
