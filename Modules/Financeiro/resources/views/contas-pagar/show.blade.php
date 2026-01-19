@extends('adminlte::page')

@section('title', 'Detalhes da Conta a Pagar')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-file-invoice-dollar"></i> Detalhes da Conta</h1>
        <div>
            <a href="{{ route('financeiro.contas-pagar.edit', $contaPagar) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
            <a href="{{ route('financeiro.contas-pagar.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <strong>Descrição</strong>
                    <p class="text-muted">{{ $contaPagar->descricao }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Fornecedor</strong>
                    <p class="text-muted">{{ $contaPagar->fornecedor }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Valor</strong>
                    <p class="text-muted">R$ {{ number_format($contaPagar->valor, 2, ',', '.') }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Data de Vencimento</strong>
                    <p class="text-muted">{{ $contaPagar->data_vencimento?->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Status</strong>
                    <p>
                        @if($contaPagar->pago)
                            <span class="badge badge-success">Pago</span>
                        @else
                            <span class="badge badge-warning">Pendente</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
