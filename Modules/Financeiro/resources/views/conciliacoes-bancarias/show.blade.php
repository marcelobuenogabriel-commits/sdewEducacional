@extends('adminlte::page')

@section('title', 'Detalhes da Conciliação Bancária')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-university"></i> Detalhes da Conciliação</h1>
        <div>
            <a href="{{ route('financeiro.conciliacoes-bancarias.edit', $conciliacaoBancaria) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
            <a href="{{ route('financeiro.conciliacoes-bancarias.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Data</strong>
                    <p class="text-muted">{{ $conciliacaoBancaria->data?->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Banco</strong>
                    <p class="text-muted">{{ $conciliacaoBancaria->banco }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Saldo Inicial</strong>
                    <p class="text-muted">R$ {{ number_format($conciliacaoBancaria->saldo_inicial, 2, ',', '.') }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Saldo Final</strong>
                    <p class="text-muted">R$ {{ number_format($conciliacaoBancaria->saldo_final, 2, ',', '.') }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Status</strong>
                    <p>
                        @if($conciliacaoBancaria->conciliado)
                            <span class="badge badge-success">Conciliado</span>
                        @else
                            <span class="badge badge-warning">Pendente</span>
                        @endif
                    </p>
                </div>
                @if($conciliacaoBancaria->observacoes)
                    <div class="col-md-12">
                        <strong>Observações</strong>
                        <p class="text-muted" style="white-space: pre-line;">{{ $conciliacaoBancaria->observacoes }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
