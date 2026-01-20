<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            // Drop existing unique constraints
            $table->dropUnique(['cpf']);
            $table->dropUnique(['email']);
            $table->dropUnique(['matricula']);
            
            // Drop foreign key and turma_id column
            $table->dropForeign(['turma_id']);
            $table->dropColumn('turma_id');
        });

        Schema::table('alunos', function (Blueprint $table) {
            // Make CPF nullable and add unique constraint for non-null values
            $table->string('cpf', 14)->nullable()->change();
            
            // Make email nullable
            $table->string('email')->nullable()->change();
            
            // Make matricula auto-increment (remove manual input requirement)
            // We'll generate it in the model/controller instead
            $table->string('matricula')->nullable()->change();
        });

        // Create unique index for CPF where it's not null
        DB::statement('CREATE UNIQUE INDEX alunos_cpf_unique ON alunos (cpf) WHERE cpf IS NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            // Drop the conditional unique index
            DB::statement('DROP INDEX IF EXISTS alunos_cpf_unique');
            
            // Restore original constraints
            $table->string('cpf', 14)->unique()->change();
            $table->string('email')->unique()->change();
            $table->string('matricula')->unique()->change();
            
            // Restore turma_id column
            $table->foreignId('turma_id')->nullable()->after('cep')->constrained('turmas')->nullOnDelete();
        });
    }
};
