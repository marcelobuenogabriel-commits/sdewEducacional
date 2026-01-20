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
        $alunos = Aluno::with('empresa')->paginate(15);
        return view('aluno::index', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empresas = \App\Models\Empresa::where('status', 'ativa')->get();
        return view('aluno::create', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => [
                'nullable',
                'string',
                'max:14',
                function ($attribute, $value, $fail) {
                    if ($value && Aluno::where('cpf', $value)->exists()) {
                        $fail('O CPF informado já está cadastrado.');
                    }
                },
            ],
            'rg' => 'nullable|string|max:20',
            'data_nascimento' => 'required|date',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'endereco' => 'nullable|string',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string',
            'bairro' => 'nullable|string',
            'cidade' => 'nullable|string',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'empresa_id' => 'nullable|exists:empresas,id',
            'observacoes' => 'nullable|string',
        ]);

        // Auto-generate matricula
        $year = date('Y');
        $lastMatricula = Aluno::whereYear('created_at', $year)
            ->whereNotNull('matricula')
            ->orderBy('matricula', 'desc')
            ->value('matricula');
        
        if ($lastMatricula) {
            $lastNumber = (int) substr($lastMatricula, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        
        $validated['matricula'] = $year . $newNumber;

        Aluno::create($validated);

        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aluno $aluno)
    {
        $aluno->load(['empresa', 'matriculas.turma']);
        return view('aluno::show', compact('aluno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aluno $aluno)
    {
        $empresas = \App\Models\Empresa::where('status', 'ativa')->get();
        return view('aluno::edit', compact('aluno', 'empresas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aluno $aluno)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => [
                'nullable',
                'string',
                'max:14',
                function ($attribute, $value, $fail) use ($aluno) {
                    if ($value && Aluno::where('cpf', $value)->where('id', '!=', $aluno->id)->exists()) {
                        $fail('O CPF informado já está cadastrado.');
                    }
                },
            ],
            'rg' => 'nullable|string|max:20',
            'data_nascimento' => 'required|date',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'endereco' => 'nullable|string',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string',
            'bairro' => 'nullable|string',
            'cidade' => 'nullable|string',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'empresa_id' => 'nullable|exists:empresas,id',
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
