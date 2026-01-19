<?php

namespace Modules\Matricula\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Matricula\Models\Matricula;
use Modules\Aluno\Models\Aluno;
use Modules\Turma\Models\Turma;
use Modules\Financeiro\Models\ContaReceber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matriculas = Matricula::with(['aluno', 'turma'])->paginate(15);
        return view('matricula::index', compact('matriculas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alunos = Aluno::where('status', 'ativo')->get();
        $turmas = Turma::where('ativo', true)->get();
        return view('matricula::create', compact('alunos', 'turmas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'turma_id' => 'required|exists:turmas,id',
            'data_matricula' => 'required|date',
            'valor_mensalidade' => 'required|numeric|min:0',
            'numero_parcelas' => 'required|integer|min:1|max:24',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'observacoes' => 'nullable|string',
        ]);

        $matricula = Matricula::create($validated);

        return redirect()->route('matriculas.index')->with('success', 'Matrícula cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Matricula $matricula)
    {
        $matricula->load(['aluno', 'turma']);
        return view('matricula::show', compact('matricula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matricula $matricula)
    {
        $alunos = Aluno::where('status', 'ativo')->get();
        $turmas = Turma::where('ativo', true)->get();
        return view('matricula::edit', compact('matricula', 'alunos', 'turmas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matricula $matricula)
    {
        $validated = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'turma_id' => 'required|exists:turmas,id',
            'data_matricula' => 'required|date',
            'status' => 'required|in:ativo,cancelado,transferido,concluido',
            'valor_mensalidade' => 'required|numeric|min:0',
            'numero_parcelas' => 'required|integer|min:1|max:24',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'observacoes' => 'nullable|string',
        ]);

        $matricula->update($validated);

        return redirect()->route('matriculas.index')->with('success', 'Matrícula atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matricula $matricula)
    {
        $matricula->delete();
        return redirect()->route('matriculas.index')->with('success', 'Matrícula excluída com sucesso!');
    }

    /**
     * Process a new enrollment (matricular).
     * This method validates available spots, creates matricula, updates turma and generates payment records.
     */
    public function matricular(Request $request)
    {
        $validated = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'turma_id' => 'required|exists:turmas,id',
            'data_matricula' => 'required|date',
            'valor_mensalidade' => 'required|numeric|min:0',
            'numero_parcelas' => 'required|integer|min:1|max:24',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'observacoes' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Load turma and validate available spots
            $turma = Turma::lockForUpdate()->findOrFail($validated['turma_id']);
            
            if ($turma->vagas_ocupadas >= $turma->vagas_total) {
                return back()->withErrors(['turma_id' => 'Não há vagas disponíveis nesta turma.'])->withInput();
            }

            // Create matricula
            $matricula = Matricula::create($validated);

            // Update turma vagas_ocupadas
            $turma->increment('vagas_ocupadas');

            // Generate contas_receber records for each parcela (month)
            $aluno = Aluno::findOrFail($validated['aluno_id']);
            $dataInicio = Carbon::parse($validated['data_inicio']);
            $numeroParcelas = $validated['numero_parcelas'];
            $valorMensalidade = $validated['valor_mensalidade'];

            for ($i = 0; $i < $numeroParcelas; $i++) {
                $dataVencimento = $dataInicio->copy()->addMonths($i);
                $numeroDocumento = sprintf(
                    'MAT-%05d-%02d/%04d',
                    $matricula->id,
                    $dataVencimento->month,
                    $dataVencimento->year
                );

                ContaReceber::create([
                    'descricao' => sprintf(
                        'Mensalidade %d/%d - %s - %s',
                        $i + 1,
                        $numeroParcelas,
                        $aluno->nome,
                        $turma->nome
                    ),
                    'numero_documento' => $numeroDocumento,
                    'valor_original' => $valorMensalidade,
                    'valor_recebido' => 0,
                    'valor_desconto' => 0,
                    'valor_juros' => 0,
                    'valor_multa' => 0,
                    'data_emissao' => $validated['data_matricula'],
                    'data_vencimento' => $dataVencimento,
                    'data_recebimento' => null,
                    'aluno_id' => $aluno->id,
                    'pagador' => $aluno->nome,
                    'cnpj_cpf_pagador' => $aluno->cpf,
                    'categoria' => 'Mensalidade',
                    'status' => 'pendente',
                    'forma_recebimento' => null,
                    'observacoes' => "Gerado automaticamente pela matrícula #{$matricula->id}",
                    'user_id' => auth()->id(),
                ]);
            }

            DB::commit();

            return redirect()->route('matriculas.show', $matricula)->with('success', 'Matrícula realizada com sucesso! Foram geradas ' . $numeroParcelas . ' parcelas de mensalidade.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao realizar matrícula: ' . $e->getMessage()])->withInput();
        }
    }
}
