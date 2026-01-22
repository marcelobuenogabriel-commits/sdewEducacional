<?php

namespace Modules\Comunicacao\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Comunicacao\Models\Mensagem;
use Modules\Turma\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MensagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mensagensRecebidas = Mensagem::with(['remetente', 'turma'])
            ->where('destinatario_id', Auth::id())
            ->orWhereHas('turma', function($query) {
                $query->whereHas('alunos', function($q) {
                    $q->where('alunos.id', Auth::id());
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('comunicacao::mensagens.index', compact('mensagensRecebidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();
        $turmas = Turma::where('ativo', true)->get();
        return view('comunicacao::mensagens.create', compact('usuarios', 'turmas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'assunto' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'tipo' => 'required|string|in:individual,turma,geral',
            'prioridade' => 'nullable|string|in:baixa,normal,alta,urgente',
            'destinatario_id' => 'required_if:tipo,individual|nullable|exists:users,id',
            'turma_id' => 'required_if:tipo,turma|nullable|exists:turmas,id',
        ]);

        $validated['remetente_id'] = Auth::id();
        $validated['data_envio'] = now();
        $validated['lida'] = false;
        $validated['arquivada'] = false;

        Mensagem::create($validated);

        return redirect()->route('comunicacao.mensagens.index')->with('success', 'Mensagem enviada com sucesso!');
    }

    /**
     * Show the specified resource.
     */
    public function show(Mensagem $mensagem)
    {
        // Mark as read if recipient
        if ($mensagem->destinatario_id === Auth::id() && !$mensagem->lida) {
            $mensagem->update([
                'lida' => true,
                'data_leitura' => now(),
            ]);
        }

        $mensagem->load(['remetente', 'destinatario', 'turma', 'respostas.remetente']);
        return view('comunicacao::mensagens.show', compact('mensagem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mensagem $mensagem)
    {
        // Only allow editing if sender and not sent yet
        if ($mensagem->remetente_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para editar esta mensagem.');
        }

        $usuarios = User::all();
        $turmas = Turma::where('ativo', true)->get();
        return view('comunicacao::mensagens.edit', compact('mensagem', 'usuarios', 'turmas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mensagem $mensagem)
    {
        // Only allow editing if sender
        if ($mensagem->remetente_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para atualizar esta mensagem.');
        }

        $validated = $request->validate([
            'assunto' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'tipo' => 'required|string|in:individual,turma,geral',
            'prioridade' => 'nullable|string|in:baixa,normal,alta,urgente',
            'destinatario_id' => 'required_if:tipo,individual|nullable|exists:users,id',
            'turma_id' => 'required_if:tipo,turma|nullable|exists:turmas,id',
        ]);

        $mensagem->update($validated);

        return redirect()->route('comunicacao.mensagens.index')->with('success', 'Mensagem atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mensagem $mensagem)
    {
        // Only allow deletion if sender
        if ($mensagem->remetente_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para excluir esta mensagem.');
        }

        $mensagem->delete();
        return redirect()->route('comunicacao.mensagens.index')->with('success', 'Mensagem excluída com sucesso!');
    }
}
