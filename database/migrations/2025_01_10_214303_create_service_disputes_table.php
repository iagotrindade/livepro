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
        Schema::create('service_disputes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained();
            $table->foreignId('complainant_id')->constrained('users');
            $table->longText('complainant_files')->nullable();
            $table->foreignId('defendant_id')->nullable()->constrained('users');
            $table->foreignId('support_agent_id')->nullable()->constrained('users');
            $table->longText('defendant_files')->nullable();
            $table->text('reason');
            $table->text('reply')->nullable();
            $table->enum('status', ['open', 'in_review', 'granted', 'dismissed'])->default('open');
            $table->text('resolution')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_disputes');
    }
};
