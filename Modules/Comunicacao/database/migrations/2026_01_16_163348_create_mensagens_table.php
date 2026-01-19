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
        Schema::create('mensagens', function (Blueprint $table) {
            $table->id();
            $table->string('assunto');
            $table->text('conteudo');
            $table->enum('tipo', ['individual', 'broadcast', 'turma', 'aviso'])->default('individual');
            $table->enum('prioridade', ['baixa', 'normal', 'alta', 'urgente'])->default('normal');
            $table->foreignId('remetente_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('destinatario_id')->nullable()->constrained('users')->onDelete('cascade'); // Null para broadcast
            $table->foreignId('turma_id')->nullable()->constrained('turmas')->onDelete('cascade'); // Para mensagens de turma
            $table->dateTime('data_envio');
            $table->dateTime('data_leitura')->nullable();
            $table->boolean('lida')->default(false);
            $table->boolean('arquivada')->default(false);
            $table->foreignId('mensagem_pai_id')->nullable()->constrained('mensagens')->onDelete('cascade'); // Para respostas
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['remetente_id', 'destinatario_id']);
            $table->index(['tipo', 'lida']);
            $table->index('turma_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensagens');
    }
};
