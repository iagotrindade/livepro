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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('cpf_cnpj');
            $table->string('owner_name');
            $table->dateTime('owner_birth_date');
            $table->enum('type', ['savings', 'current']);
            $table->string('agency');
            $table->string('account');
            $table->string('account_check_digit');
            $table->dateTime('last_use');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banc_accounts');
    }
};
