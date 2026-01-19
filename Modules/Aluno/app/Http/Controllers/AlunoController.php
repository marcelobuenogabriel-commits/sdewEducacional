<?php

namespace Modules\Aluno\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Aluno\Models\Aluno;
use Modules\Turma\Models\Turma;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alunos = Aluno::with('turma')->paginate(15);
        return view('aluno::index', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $turmas = Turma::where('ativo', true)->get();
        return view('aluno::create', compact('turmas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:alunos',
            'rg' => 'nullable|string|max:20',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|unique:alunos',
            'telefone' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'endereco' => 'nullable|string',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string',
            'bairro' => 'nullable|string',
            'cidade' => 'nullable|string',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'turma_id' => 'nullable|exists:turmas,id',
            'matricula' => 'required|string|unique:alunos',
            'observacoes' => 'nullable|string',
        ]);

        Aluno::create($validated);

        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aluno $aluno)
    {
        $aluno->load('turma');
        return view('aluno::show', compact('aluno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aluno $aluno)
    {
        $turmas = Turma::where('ativo', true)->get();
        return view('aluno::edit', compact('aluno', 'turmas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aluno $aluno)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:alunos,cpf,' . $aluno->id,
            'rg' => 'nullable|string|max:20',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|unique:alunos,email,' . $aluno->id,
            'telefone' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'endereco' => 'nullable|string',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string',
            'bairro' => 'nullable|string',
            'cidade' => 'nullable|string',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'turma_id' => 'nullable|exists:turmas,id',
            'matricula' => 'required|string|unique:alunos,matricula,' . $aluno->id,
            'status' => 'required|in:ativo,inativo,trancado,concluido',
            'observacoes' => 'nullable|string',
        ]);

        $aluno->update($validated);

        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aluno $aluno)
    {
        $aluno->delete();
        return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso!');
    }
}
