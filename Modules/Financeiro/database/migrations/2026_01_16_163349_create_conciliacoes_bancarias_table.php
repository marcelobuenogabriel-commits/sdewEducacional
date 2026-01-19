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
        Schema::create('conciliacoes_bancarias', function (Blueprint $table) {
            $table->id();
            $table->string('banco');
            $table->string('agencia');
            $table->string('conta');
            $table->date('data_extrato');
            $table->string('arquivo_importado')->nullable(); // Path do arquivo OFX/CSV
            $table->text('conteudo_extrato')->nullable(); // Conteúdo do arquivo importado
            $table->decimal('saldo_inicial', 10, 2);
            $table->decimal('saldo_final', 10, 2);
            $table->decimal('total_creditos', 10, 2)->default(0);
            $table->decimal('total_debitos', 10, 2)->default(0);
            $table->integer('transacoes_conciliadas')->default(0);
            $table->integer('transacoes_pendentes')->default(0);
            $table->enum('status', ['pendente', 'em_andamento', 'concluida', 'erro'])->default('pendente');
            $table->text('observacoes')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Quem fez a conciliação
            $table->dateTime('data_conciliacao')->nullable();
            $table->timestamps();
            
            $table->index(['banco', 'conta', 'data_extrato']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conciliacoes_bancarias');
    }
};
