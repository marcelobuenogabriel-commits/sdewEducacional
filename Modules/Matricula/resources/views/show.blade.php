@extends('adminlte::page')

@section('title', 'Detalhes da Matrícula')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-file-signature"></i> Detalhes da Matrícula</h1>
        <div>
            <a href="{{ route('matriculas.edit', $matricula) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
            <a href="{{ route('matriculas.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-info-circle"></i> Informações da Matrícula</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-user"></i> Aluno</strong>
                    <p class="text-muted">{{ $matricula->aluno?->nome ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-users"></i> Turma</strong>
                    <p class="text-muted">{{ $matricula->turma?->nome ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-calendar"></i> Data da Matrícula</strong>
                    <p class="text-muted">{{ $matricula->data_matricula->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-money-bill"></i> Valor Mensalidade</strong>
                    <p class="text-muted">R$ {{ number_format($matricula->valor_mensalidade, 2, ',', '.') }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-flag"></i> Status</strong>
                    <p>
                        @if($matricula->status === 'ativo')
                            <span class="badge badge-success">Ativo</span>
                        @elseif($matricula->status === 'cancelado')
                            <span class="badge badge-danger">Cancelado</span>
                        @elseif($matricula->status === 'transferido')
                            <span class="badge badge-warning">Transferido</span>
                        @else
                            <span class="badge badge-info">Concluído</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
