@extends('adminlte::page')

@section('title', 'Detalhes da Turma')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-users"></i> Detalhes da Turma</h1>
        <div>
            <a href="{{ route('turmas.edit', $turma) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
            <a href="{{ route('turmas.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-info-circle"></i> Informações da Turma</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-tag"></i> Nome</strong>
                    <p class="text-muted">{{ $turma->nome }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-barcode"></i> Código</strong>
                    <p class="text-muted">{{ $turma->codigo }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-calendar"></i> Ano Letivo</strong>
                    <p class="text-muted">{{ $turma->ano }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-clock"></i> Período</strong>
                    <p class="text-muted">{{ ucfirst($turma->periodo) }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-users"></i> Vagas</strong>
                    <p class="text-muted">{{ $turma->vagas_ocupadas }} / {{ $turma->vagas_total }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-flag"></i> Status</strong>
                    <p>
                        @if($turma->ativo)
                            <span class="badge badge-success">Ativa</span>
                        @else
                            <span class="badge badge-danger">Inativa</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
