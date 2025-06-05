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
        Schema::create('document_validations', function (Blueprint $table) {
            $table->id();
            $table->string('protocol');
            $table->foreignId('professional_documents_id')->onDelete('cascade');
            $table->foreignId('support_agent_id')->constrained(
                table: 'users', indexName: 'support_agent_id_in_document_validations'
            );
            $table->string('justification')->nullable();
            $table->enum('status', ['validated', 'pending', 'invalidated', 'in_progress', 'on_appeal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_validations');
    }
};
