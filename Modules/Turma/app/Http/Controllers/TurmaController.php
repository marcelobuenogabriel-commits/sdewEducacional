<?php

namespace Modules\Turma\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Turma\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turmas = Turma::with('alunos')->paginate(15);
        return view('turma::index', compact('turmas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('turma::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:turmas',
            'descricao' => 'nullable|string',
            'ano' => 'required|integer|min:2000|max:2100',
            'periodo' => 'required|in:matutino,vespertino,noturno,integral',
            'vagas_total' => 'required|integer|min:1',
        ]);

        Turma::create($validated);

        return redirect()->route('turmas.index')->with('success', 'Turma criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Turma $turma)
    {
        $turma->load('alunos');
        return view('turma::show', compact('turma'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Turma $turma)
    {
        return view('turma::edit', compact('turma'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Turma $turma)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:turmas,codigo,' . $turma->id,
            'descricao' => 'nullable|string',
            'ano' => 'required|integer|min:2000|max:2100',
            'periodo' => 'required|in:matutino,vespertino,noturno,integral',
            'vagas_total' => 'required|integer|min:1',
            'ativo' => 'boolean',
        ]);

        $turma->update($validated);

        return redirect()->route('turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Turma $turma)
    {
        $turma->delete();
        return redirect()->route('turmas.index')->with('success', 'Turma excluída com sucesso!');
    }
}
