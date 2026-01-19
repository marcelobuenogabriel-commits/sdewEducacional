<?php

namespace Modules\Disciplina\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Disciplina\Models\Disciplina;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disciplinas = Disciplina::with('professores')->paginate(15);
        return view('disciplina::index', compact('disciplinas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('disciplina::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:disciplinas',
            'descricao' => 'nullable|string',
            'carga_horaria' => 'nullable|integer|min:1',
            'creditos' => 'nullable|integer|min:1',
            'ementa' => 'nullable|string',
        ]);

        Disciplina::create($validated);

        return redirect()->route('disciplinas.index')->with('success', 'Disciplina criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Disciplina $disciplina)
    {
        $disciplina->load('professores', 'turmas');
        return view('disciplina::show', compact('disciplina'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disciplina $disciplina)
    {
        return view('disciplina::edit', compact('disciplina'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disciplina $disciplina)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:disciplinas,codigo,' . $disciplina->id,
            'descricao' => 'nullable|string',
            'carga_horaria' => 'nullable|integer|min:1',
            'creditos' => 'nullable|integer|min:1',
            'ementa' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $disciplina->update($validated);

        return redirect()->route('disciplinas.index')->with('success', 'Disciplina atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disciplina $disciplina)
    {
        $disciplina->delete();
        return redirect()->route('disciplinas.index')->with('success', 'Disciplina excluída com sucesso!');
    }
}
