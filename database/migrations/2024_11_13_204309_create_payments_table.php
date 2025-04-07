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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained(
                table: 'users', indexName: 'client_id_in_payments'
            );
            $table->foreignId('professional_id')->nullable()->constrained(
                table: 'users', indexName: 'professional_id_in_payments'
            );
            $table->foreignId('pix_key_id')->nullable()->constrained();
            $table->foreignId('bank_account_id')->nullable()->constrained();
            $table->foreignId('credit_card_id')->nullable()->constrained();
            $table->enum('type', ['subscription', 'call']);
            $table->enum('method', ['pix', 'card', 'bank_slip']);
            $table->enum('status', ['pending', 'finalized', 'refounded', 'canceled']);
            $table->float('amount');
            $table->float('profit_tax');
            $table->ipAddress('remote_ip');
            $table->dateTime('due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
