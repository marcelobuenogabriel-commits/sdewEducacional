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
        Schema::create('contas_pagar', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('numero_documento')->unique();
            $table->decimal('valor_original', 10, 2);
            $table->decimal('valor_pago', 10, 2)->default(0);
            $table->decimal('valor_desconto', 10, 2)->default(0);
            $table->decimal('valor_juros', 10, 2)->default(0);
            $table->decimal('valor_multa', 10, 2)->default(0);
            $table->date('data_emissao');
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
            $table->string('fornecedor');
            $table->string('cnpj_cpf_fornecedor')->nullable();
            $table->string('categoria'); // Salários, fornecedores, impostos, etc.
            $table->enum('status', ['pendente', 'pago', 'atrasado', 'cancelado'])->default('pendente');
            $table->string('forma_pagamento')->nullable(); // Dinheiro, transferência, cartão, etc.
            $table->text('observacoes')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Quem registrou
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['status', 'data_vencimento']);
            $table->index('fornecedor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas_pagar');
    }
};
