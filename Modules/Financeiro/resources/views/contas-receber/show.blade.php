@extends('adminlte::page')

@section('title', 'Detalhes da Conta a Receber')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-money-bill-wave"></i> Detalhes da Conta</h1>
        <div>
            <a href="{{ route('financeiro.contas-receber.edit', $contaReceber) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
            <a href="{{ route('financeiro.contas-receber.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <strong>Descrição</strong>
                    <p class="text-muted">{{ $contaReceber->descricao }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Cliente/Aluno</strong>
                    <p class="text-muted">{{ $contaReceber->cliente }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Valor</strong>
                    <p class="text-muted">R$ {{ number_format($contaReceber->valor, 2, ',', '.') }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Data de Vencimento</strong>
                    <p class="text-muted">{{ $contaReceber->data_vencimento?->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Status</strong>
                    <p>
                        @if($contaReceber->recebido)
                            <span class="badge badge-success">Recebido</span>
                        @else
                            <span class="badge badge-warning">Pendente</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
