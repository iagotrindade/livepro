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
        Schema::create('refounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained();
            $table->foreignId('support_agent_id')->constrained(
                table: 'users', indexName: 'support_agent_id_for_refounds'
            )->nullable();
            $table->string('reason');
            $table->string('response')->nullable();
            $table->enum('status', ['pending', 'under_analysis', 'solved']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refounds');
    }
};
