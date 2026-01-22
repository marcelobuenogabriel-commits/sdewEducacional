<?php

namespace Modules\Financeiro\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Financeiro\Models\ConciliacaoBancaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConciliacaoBancariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conciliacoes = ConciliacaoBancaria::with('user')->orderBy('data_extrato', 'desc')->paginate(15);
        return view('financeiro::conciliacoes-bancarias.index', compact('conciliacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('financeiro::conciliacoes-bancarias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'banco' => 'required|string|max:255',
            'agencia' => 'required|string|max:50',
            'conta' => 'required|string|max:50',
            'data_extrato' => 'required|date',
            'arquivo_importado' => 'nullable|string|max:255',
            'saldo_inicial' => 'required|numeric',
            'saldo_final' => 'required|numeric',
            'total_creditos' => 'nullable|numeric|min:0',
            'total_debitos' => 'nullable|numeric|min:0',
            'transacoes_conciliadas' => 'nullable|integer|min:0',
            'transacoes_pendentes' => 'nullable|integer|min:0',
            'observacoes' => 'nullable|string',
        ]);

        $validated['status'] = 'em_andamento';
        $validated['user_id'] = Auth::id();
        $validated['total_creditos'] = $validated['total_creditos'] ?? 0;
        $validated['total_debitos'] = $validated['total_debitos'] ?? 0;
        $validated['transacoes_conciliadas'] = $validated['transacoes_conciliadas'] ?? 0;
        $validated['transacoes_pendentes'] = $validated['transacoes_pendentes'] ?? 0;

        ConciliacaoBancaria::create($validated);

        return redirect()->route('financeiro.conciliacoes-bancarias.index')->with('success', 'Conciliação bancária iniciada com sucesso!');
    }

    /**
     * Show the specified resource.
     */
    public function show(ConciliacaoBancaria $conciliacaoBancaria)
    {
        $conciliacaoBancaria->load('user');
        return view('financeiro::conciliacoes-bancarias.show', compact('conciliacaoBancaria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConciliacaoBancaria $conciliacaoBancaria)
    {
        return view('financeiro::conciliacoes-bancarias.edit', compact('conciliacaoBancaria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConciliacaoBancaria $conciliacaoBancaria)
    {
        $validated = $request->validate([
            'banco' => 'required|string|max:255',
            'agencia' => 'required|string|max:50',
            'conta' => 'required|string|max:50',
            'data_extrato' => 'required|date',
            'arquivo_importado' => 'nullable|string|max:255',
            'saldo_inicial' => 'required|numeric',
            'saldo_final' => 'required|numeric',
            'total_creditos' => 'required|numeric|min:0',
            'total_debitos' => 'required|numeric|min:0',
            'transacoes_conciliadas' => 'required|integer|min:0',
            'transacoes_pendentes' => 'required|integer|min:0',
            'status' => 'required|string|in:em_andamento,concluida,cancelada',
            'observacoes' => 'nullable|string',
        ]);

        // If completing the reconciliation
        if ($validated['status'] === 'concluida' && $conciliacaoBancaria->status !== 'concluida') {
            $validated['data_conciliacao'] = now();
        }

        $conciliacaoBancaria->update($validated);

        return redirect()->route('financeiro.conciliacoes-bancarias.index')->with('success', 'Conciliação bancária atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConciliacaoBancaria $conciliacaoBancaria)
    {
        $conciliacaoBancaria->delete();
        return redirect()->route('financeiro.conciliacoes-bancarias.index')->with('success', 'Conciliação bancária excluída com sucesso!');
    }
}
