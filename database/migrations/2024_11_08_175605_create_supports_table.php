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
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('support_agent_id')->constrained(
                table: 'users', indexName: 'support_agent_id_in_supports'
            )->nullable();
            $table->foreignId('support_categories_id')->constrained();
            $table->string('subject');
            $table->string('protocol');
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed']);
            $table->string('resolution')->nullable();
            $table->string('user_files')->nullable();
            $table->string('support_files')->nullable();
            $table->timestamps();
            $table->dateTime('closed_at')->nullable();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};
