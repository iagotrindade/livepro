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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('plan_id')->constrained();
            $table->foreignId('payment_id')->constrained();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('renewal_date')->nullable();
            $table->date('trial_end_date')->nullable();
            $table->date('canceled_at')->nullable();
            $table->enum('status', ['active', 'inative']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
