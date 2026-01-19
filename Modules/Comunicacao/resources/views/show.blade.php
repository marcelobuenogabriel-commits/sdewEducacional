@extends('adminlte::page')

@section('title', 'Detalhes da Comunicação')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-envelope"></i> Detalhes da Comunicação</h1>
        <div>
            <a href="{{ route('comunicacoes.edit', $comunicacao) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
            <a href="{{ route('comunicacoes.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <strong><i class="fas fa-heading"></i> Título</strong>
                    <p class="text-muted">{{ $comunicacao->titulo }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-tag"></i> Tipo</strong>
                    <p class="text-muted">{{ ucfirst($comunicacao->tipo ?? 'email') }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-user"></i> Destinatário</strong>
                    <p class="text-muted">{{ $comunicacao->destinatario }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-calendar"></i> Data de Envio</strong>
                    <p class="text-muted">{{ $comunicacao->data_envio?->format('d/m/Y H:i') ?? 'Não enviado' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-flag"></i> Status</strong>
                    <p>
                        @if($comunicacao->enviado ?? false)
                            <span class="badge badge-success">Enviado</span>
                        @else
                            <span class="badge badge-warning">Pendente</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-12">
                    <strong><i class="fas fa-comment"></i> Mensagem</strong>
                    <p class="text-muted" style="white-space: pre-line;">{{ $comunicacao->mensagem }}</p>
                </div>
            </div>
        </div>
    </div>
@stop
