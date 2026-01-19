@extends('adminlte::page')

@section('title', 'Detalhes da Avaliação')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-clipboard-check"></i> Detalhes da Avaliação</h1>
        <div>
            <a href="{{ route('avaliacoes.edit', $avaliacao) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
            <a href="{{ route('avaliacoes.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-book"></i> Disciplina</strong>
                    <p class="text-muted">{{ $avaliacao->disciplina?->nome ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-users"></i> Turma</strong>
                    <p class="text-muted">{{ $avaliacao->turma?->nome ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-tag"></i> Tipo</strong>
                    <p class="text-muted">{{ ucfirst($avaliacao->tipo ?? 'prova') }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-calendar"></i> Data</strong>
                    <p class="text-muted">{{ $avaliacao->data_avaliacao?->format('d/m/Y') ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-star"></i> Valor/Peso</strong>
                    <p class="text-muted">{{ $avaliacao->valor ?? '0' }}</p>
                </div>
            </div>
        </div>
    </div>
@stop
