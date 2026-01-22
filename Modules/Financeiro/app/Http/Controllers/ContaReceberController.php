<?php

namespace Modules\Financeiro\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Financeiro\Models\ContaReceber;
use Modules\Aluno\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContaReceberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contasReceber = ContaReceber::with(['user', 'aluno'])->orderBy('data_vencimento', 'desc')->paginate(15);
        return view('financeiro::contas-receber.index', compact('contasReceber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alunos = Aluno::where('status', 'ativo')->get();
        return view('financeiro::contas-receber.create', compact('alunos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'descricao' => 'required|string|max:255',
            'numero_documento' => 'nullable|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_emissao' => 'required|date',
            'data_vencimento' => 'required|date|after_or_equal:data_emissao',
            'aluno_id' => 'nullable|exists:alunos,id',
            'pagador' => 'nullable|string|max:255',
            'cnpj_cpf_pagador' => 'nullable|string|max:18',
            'categoria' => 'nullable|string|in:mensalidade,matricula,material,outros',
            'forma_recebimento' => 'nullable|string|in:dinheiro,pix,cartao_credito,cartao_debito,boleto,transferencia',
            'observacoes' => 'nullable|string',
        ]);

        // Convert masked currency value to decimal
        if (isset($validated['valor'])) {
            $validated['valor_original'] = $validated['valor'];
            unset($validated['valor']);
        }

        $validated['status'] = 'pendente';
        $validated['user_id'] = Auth::id();

        ContaReceber::create($validated);

        return redirect()->route('financeiro.contas-receber.index')->with('success', 'Conta a receber cadastrada com sucesso!');
    }

    /**
     * Show the specified resource.
     */
    public function show(ContaReceber $contaReceber)
    {
        $contaReceber->load(['user', 'aluno']);
        return view('financeiro::contas-receber.show', compact('contaReceber'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContaReceber $contaReceber)
    {
        $alunos = Aluno::all();
        return view('financeiro::contas-receber.edit', compact('contaReceber', 'alunos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContaReceber $contaReceber)
    {
        $validated = $request->validate([
            'descricao' => 'required|string|max:255',
            'numero_documento' => 'nullable|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_emissao' => 'required|date',
            'data_vencimento' => 'required|date|after_or_equal:data_emissao',
            'data_recebimento' => 'nullable|date',
            'aluno_id' => 'nullable|exists:alunos,id',
            'pagador' => 'nullable|string|max:255',
            'cnpj_cpf_pagador' => 'nullable|string|max:18',
            'categoria' => 'nullable|string|in:mensalidade,matricula,material,outros',
            'status' => 'required|string|in:pendente,recebido,cancelado',
            'forma_recebimento' => 'nullable|string|in:dinheiro,pix,cartao_credito,cartao_debito,boleto,transferencia',
            'valor_recebido' => 'nullable|numeric|min:0',
            'valor_desconto' => 'nullable|numeric|min:0',
            'valor_juros' => 'nullable|numeric|min:0',
            'valor_multa' => 'nullable|numeric|min:0',
            'observacoes' => 'nullable|string',
        ]);

        // Convert masked currency value to decimal
        if (isset($validated['valor'])) {
            $validated['valor_original'] = $validated['valor'];
            unset($validated['valor']);
        }

        $contaReceber->update($validated);

        return redirect()->route('financeiro.contas-receber.index')->with('success', 'Conta a receber atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContaReceber $contaReceber)
    {
        $contaReceber->delete();
        return redirect()->route('financeiro.contas-receber.index')->with('success', 'Conta a receber excluída com sucesso!');
    }
}
