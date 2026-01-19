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
        Schema::create('relatorios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('tipo'); // boletim, frequencia, desempenho, financeiro, custom
            $table->text('descricao')->nullable();
            $table->json('parametros')->nullable(); // Parâmetros do relatório
            $table->json('filtros')->nullable(); // Filtros aplicados
            $table->string('formato')->default('pdf'); // pdf, excel, csv
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Quem gerou
            $table->dateTime('data_geracao');
            $table->string('caminho_arquivo')->nullable(); // Path do arquivo gerado
            $table->enum('status', ['pendente', 'processando', 'concluido', 'erro'])->default('pendente');
            $table->text('erro_mensagem')->nullable();
            $table->timestamps();
            
            $table->index(['tipo', 'status']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatorios');
    }
};
