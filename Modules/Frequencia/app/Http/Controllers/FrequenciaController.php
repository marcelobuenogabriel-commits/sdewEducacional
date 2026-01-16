<?php

namespace Modules\Frequencia\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Frequencia\Models\Frequencia;
use Modules\Aluno\Models\Aluno;
use Modules\Disciplina\Models\Disciplina;
use Modules\Turma\Models\Turma;
use Modules\Professor\Models\Professor;
use Illuminate\Http\Request;

class FrequenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $frequencias = Frequencia::with(['aluno', 'disciplina', 'turma', 'professor'])->paginate(15);
        return view('frequencia::index', compact('frequencias'));
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
        
        return view('frequencia::create', compact('alunos', 'disciplinas', 'turmas', 'professores'));
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
            'data' => 'required|date',
            'presenca' => 'required|boolean',
            'justificativa' => 'nullable|string',
            'observacoes' => 'nullable|string',
        ]);

        Frequencia::create($validated);

        return redirect()->route('frequencias.index')->with('success', 'Frequência registrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Frequencia $frequencia)
    {
        $frequencia->load(['aluno', 'disciplina', 'turma', 'professor']);
        return view('frequencia::show', compact('frequencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Frequencia $frequencia)
    {
        $alunos = Aluno::where('status', 'ativo')->get();
        $disciplinas = Disciplina::where('ativo', true)->get();
        $turmas = Turma::where('ativo', true)->get();
        $professores = Professor::where('status', 'ativo')->get();
        
        return view('frequencia::edit', compact('frequencia', 'alunos', 'disciplinas', 'turmas', 'professores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Frequencia $frequencia)
    {
        $validated = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'disciplina_id' => 'required|exists:disciplinas,id',
            'turma_id' => 'required|exists:turmas,id',
            'professor_id' => 'required|exists:professores,id',
            'data' => 'required|date',
            'presenca' => 'required|boolean',
            'justificativa' => 'nullable|string',
            'observacoes' => 'nullable|string',
        ]);

        $frequencia->update($validated);

        return redirect()->route('frequencias.index')->with('success', 'Frequência atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Frequencia $frequencia)
    {
        $frequencia->delete();
        return redirect()->route('frequencias.index')->with('success', 'Frequência excluída com sucesso!');
    }
}
