<?php

namespace Modules\Financeiro\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Financeiro\Models\ContaPagar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContaPagarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contasPagar = ContaPagar::with('user')->orderBy('data_vencimento', 'desc')->paginate(15);
        return view('financeiro::contas-pagar.index', compact('contasPagar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('financeiro::contas-pagar.create');
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
            'fornecedor' => 'nullable|string|max:255',
            'cnpj_cpf_fornecedor' => 'nullable|string|max:18',
            'categoria' => 'nullable|string|in:salario,aluguel,fornecedor,outros',
            'forma_pagamento' => 'nullable|string|in:dinheiro,pix,cartao_credito,cartao_debito,boleto,transferencia',
            'observacoes' => 'nullable|string',
        ]);

        // Convert masked currency value to decimal
        if (isset($validated['valor'])) {
            $validated['valor_original'] = $validated['valor'];
            unset($validated['valor']);
        }

        $validated['status'] = 'pendente';
        $validated['user_id'] = Auth::id();

        ContaPagar::create($validated);

        return redirect()->route('financeiro.contas-pagar.index')->with('success', 'Conta a pagar cadastrada com sucesso!');
    }

    /**
     * Show the specified resource.
     */
    public function show(ContaPagar $contaPagar)
    {
        $contaPagar->load('user');
        return view('financeiro::contas-pagar.show', compact('contaPagar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContaPagar $contaPagar)
    {
        return view('financeiro::contas-pagar.edit', compact('contaPagar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContaPagar $contaPagar)
    {
        $validated = $request->validate([
            'descricao' => 'required|string|max:255',
            'numero_documento' => 'nullable|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_emissao' => 'required|date',
            'data_vencimento' => 'required|date|after_or_equal:data_emissao',
            'data_pagamento' => 'nullable|date',
            'fornecedor' => 'nullable|string|max:255',
            'cnpj_cpf_fornecedor' => 'nullable|string|max:18',
            'categoria' => 'nullable|string|in:salario,aluguel,fornecedor,outros',
            'status' => 'required|string|in:pendente,pago,cancelado',
            'forma_pagamento' => 'nullable|string|in:dinheiro,pix,cartao_credito,cartao_debito,boleto,transferencia',
            'valor_pago' => 'nullable|numeric|min:0',
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

        $contaPagar->update($validated);

        return redirect()->route('financeiro.contas-pagar.index')->with('success', 'Conta a pagar atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContaPagar $contaPagar)
    {
        $contaPagar->delete();
        return redirect()->route('financeiro.contas-pagar.index')->with('success', 'Conta a pagar excluída com sucesso!');
    }
}
