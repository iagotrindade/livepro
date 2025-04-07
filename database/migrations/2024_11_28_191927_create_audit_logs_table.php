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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->morphs('entity');
            $table->string('entity_name')->nullable();
            $table->string('event');
            $table->string('description')->nullable();
            $table->longText('url')->nullable();
            $table->ipAddress('ip_address');
            $table->string('user_agent');
            $table->longText('changes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit');
    }
};
