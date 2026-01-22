<?php

namespace Modules\Professor\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Professor\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professores = Professor::with('turmas')->paginate(15);
        return view('professor::index', compact('professores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('professor::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:professores',
            'rg' => 'nullable|string|max:20',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|unique:professores',
            'telefone' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'endereco' => 'nullable|string',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string',
            'bairro' => 'nullable|string',
            'cidade' => 'nullable|string',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'especialidade' => 'nullable|string|max:255',
            'formacao' => 'nullable|string|max:255',
            'registro_profissional' => 'nullable|string|max:255|unique:professores',
            'data_admissao' => 'nullable|date',
            'observacoes' => 'nullable|string',
        ]);

        try {
            Professor::create($validated);
            return redirect()->route('professores.index')->with('success', 'Professor cadastrado com sucesso!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Log the error for debugging
            \Log::error('Erro ao cadastrar professor: ' . $e->getMessage());
            
            return redirect()->route('professores.create')
                ->withInput()
                ->withErrors(['message' => 'Falha ao salvar o cadastro. Verifique os dados e tente novamente.']);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Erro inesperado ao cadastrar professor: ' . $e->getMessage());
            
            return redirect()->route('professores.create')
                ->withInput()
                ->withErrors(['message' => 'Ocorreu um erro inesperado. Por favor, tente novamente.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Professor $professor)
    {
        $professor->load('turmas', 'disciplinas');
        return view('professor::show', compact('professor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professor $professor)
    {
        return view('professor::edit', compact('professor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Professor $professor)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:professores,cpf,' . $professor->id,
            'rg' => 'nullable|string|max:20',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|unique:professores,email,' . $professor->id,
            'telefone' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'endereco' => 'nullable|string',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string',
            'bairro' => 'nullable|string',
            'cidade' => 'nullable|string',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'especialidade' => 'nullable|string|max:255',
            'formacao' => 'nullable|string|max:255',
            'registro_profissional' => 'nullable|string|max:255|unique:professores,registro_profissional,' . $professor->id,
            'data_admissao' => 'nullable|date',
            'status' => 'required|in:ativo,inativo,afastado,aposentado',
            'observacoes' => 'nullable|string',
        ]);

        try {
            $professor->update($validated);
            return redirect()->route('professores.index')->with('success', 'Professor atualizado com sucesso!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Log the error for debugging
            \Log::error('Erro ao atualizar professor: ' . $e->getMessage());
            
            return redirect()->route('professores.edit', $professor)
                ->withInput()
                ->withErrors(['message' => 'Falha ao atualizar o cadastro. Verifique os dados e tente novamente.']);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Erro inesperado ao atualizar professor: ' . $e->getMessage());
            
            return redirect()->route('professores.edit', $professor)
                ->withInput()
                ->withErrors(['message' => 'Ocorreu um erro inesperado. Por favor, tente novamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professor $professor)
    {
        $professor->delete();
        return redirect()->route('professores.index')->with('success', 'Professor excluído com sucesso!');
    }
}
