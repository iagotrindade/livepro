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
        Schema::create('review_disputes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained();
            $table->string('reason')->nullable();
            $table->string('response')->nullable();
            $table->enum('result', ['under_analysis', 'granted', 'dismissed'])->default('under_analysis');
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_disputes');
    }
};
