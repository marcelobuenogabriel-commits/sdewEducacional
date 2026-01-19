<?php

namespace Modules\Relatorio\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Relatorio\Models\Relatorio;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relatorios = Relatorio::with('user')->latest()->paginate(15);
        return view('relatorio::index', compact('relatorios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('relatorio::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string',
            'descricao' => 'nullable|string',
            'formato' => 'required|in:pdf,excel,csv',
            'parametros' => 'nullable|array',
            'filtros' => 'nullable|array',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['data_geracao'] = now();
        $validated['status'] = 'pendente';

        $relatorio = Relatorio::create($validated);

        return redirect()->route('relatorios.index')
            ->with('success', 'Relatório criado com sucesso.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $relatorio = Relatorio::with('user')->findOrFail($id);
        return view('relatorio::show', compact('relatorio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $relatorio = Relatorio::findOrFail($id);
        return view('relatorio::edit', compact('relatorio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $relatorio = Relatorio::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string',
            'descricao' => 'nullable|string',
            'formato' => 'required|in:pdf,excel,csv',
            'status' => 'required|in:pendente,processando,concluido,erro',
        ]);

        $relatorio->update($validated);

        return redirect()->route('relatorios.index')
            ->with('success', 'Relatório atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $relatorio = Relatorio::findOrFail($id);
        $relatorio->delete();

        return redirect()->route('relatorios.index')
            ->with('success', 'Relatório excluído com sucesso.');
    }
}
