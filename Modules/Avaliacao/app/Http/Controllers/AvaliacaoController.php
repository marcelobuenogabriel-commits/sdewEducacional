<?php

namespace Modules\Avaliacao\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Avaliacao\Models\Avaliacao;
use Modules\Aluno\Models\Aluno;
use Modules\Disciplina\Models\Disciplina;
use Modules\Turma\Models\Turma;
use Modules\Professor\Models\Professor;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avaliacoes = Avaliacao::with(['aluno', 'disciplina', 'turma', 'professor'])->paginate(15);
        return view('avaliacao::index', compact('avaliacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alunos = Aluno::where('status', 'ativo')->get();
        $disciplinas = Disciplina::where('ativo', true)->get();
        $turmas = Turma::where('ativo', true)->get();
        $professores = Professor::where('status', 'ativo')->get();
        
        return view('avaliacao::create', compact('alunos', 'disciplinas', 'turmas', 'professores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'disciplina_id' => 'required|exists:disciplinas,id',
            'turma_id' => 'required|exists:turmas,id',
            'professor_id' => 'required|exists:professores,id',
            'tipo_avaliacao' => 'required|in:prova,trabalho,seminario,projeto,participacao,recuperacao,outro',
            'descricao' => 'required|string|max:255',
            'data_avaliacao' => 'required|date',
            'nota' => 'required|numeric|min:0|max:10',
            'peso' => 'required|numeric|min:0.1|max:10',
            'observacoes' => 'nullable|string',
        ]);

        Avaliacao::create($validated);

        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Avaliacao $avaliacao)
    {
        $avaliacao->load(['aluno', 'disciplina', 'turma', 'professor']);
        return view('avaliacao::show', compact('avaliacao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Avaliacao $avaliacao)
    {
        $alunos = Aluno::where('status', 'ativo')->get();
        $disciplinas = Disciplina::where('ativo', true)->get();
        $turmas = Turma::where('ativo', true)->get();
        $professores = Professor::where('status', 'ativo')->get();
        
        return view('avaliacao::edit', compact('avaliacao', 'alunos', 'disciplinas', 'turmas', 'professores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Avaliacao $avaliacao)
    {
        $validated = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'disciplina_id' => 'required|exists:disciplinas,id',
            'turma_id' => 'required|exists:turmas,id',
            'professor_id' => 'required|exists:professores,id',
            'tipo_avaliacao' => 'required|in:prova,trabalho,seminario,projeto,participacao,recuperacao,outro',
            'descricao' => 'required|string|max:255',
            'data_avaliacao' => 'required|date',
            'nota' => 'required|numeric|min:0|max:10',
            'peso' => 'required|numeric|min:0.1|max:10',
            'observacoes' => 'nullable|string',
        ]);

        $avaliacao->update($validated);

        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Avaliacao $avaliacao)
    {
        $avaliacao->delete();
        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação excluída com sucesso!');
    }
}
