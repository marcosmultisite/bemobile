<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // Adiciona chaves estrangeiras para Client e Gateway
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('gateway_id')->constrained('gateways');
            
            $table->string('external_id')->nullable(); // ID retornado pelo gateway
            $table->string('status'); // pending, paid, refunded, failed
            $table->decimal('amount', 8, 2); // Valor total calculado no back-end
            $table->string('card_last_numbers', 4)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
