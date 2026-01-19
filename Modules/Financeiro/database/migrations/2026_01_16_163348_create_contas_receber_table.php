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
        Schema::create('contas_receber', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('numero_documento')->unique();
            $table->decimal('valor_original', 10, 2);
            $table->decimal('valor_recebido', 10, 2)->default(0);
            $table->decimal('valor_desconto', 10, 2)->default(0);
            $table->decimal('valor_juros', 10, 2)->default(0);
            $table->decimal('valor_multa', 10, 2)->default(0);
            $table->date('data_emissao');
            $table->date('data_vencimento');
            $table->date('data_recebimento')->nullable();
            $table->foreignId('aluno_id')->nullable()->constrained('alunos')->onDelete('cascade'); // Se for mensalidade
            $table->string('pagador'); // Nome do pagador
            $table->string('cnpj_cpf_pagador')->nullable();
            $table->string('categoria'); // Mensalidade, matrícula, material, etc.
            $table->enum('status', ['pendente', 'recebido', 'atrasado', 'cancelado'])->default('pendente');
            $table->string('forma_recebimento')->nullable(); // Dinheiro, transferência, cartão, etc.
            $table->text('observacoes')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Quem registrou
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['status', 'data_vencimento']);
            $table->index('aluno_id');
            $table->index('pagador');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas_receber');
    }
};
