<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::paginate(15);
        return view('empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:empresas',
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
            'responsavel' => 'nullable|string|max:255',
            'observacoes' => 'nullable|string',
        ]);

        Empresa::create($validated);

        return redirect()->route('empresas.index')->with('success', 'Empresa cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        $empresa->load('alunos');
        return view('empresas.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:empresas,cnpj,' . $empresa->id,
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
            'responsavel' => 'nullable|string|max:255',
            'status' => 'required|in:ativa,inativa',
            'observacoes' => 'nullable|string',
        ]);

        $empresa->update($validated);

        return redirect()->route('empresas.index')->with('success', 'Empresa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        return redirect()->route('empresas.index')->with('success', 'Empresa excluída com sucesso!');
    }
}
