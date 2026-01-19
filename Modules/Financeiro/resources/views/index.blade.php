@extends('adminlte::page')

@section('title', 'Financeiro')

@section('content_header')
    <h1><i class="fas fa-dollar-sign"></i> Gestão Financeira</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>R$ 0,00</h3>
                    <p>Contas a Receber</p>
                </div>
                <div class="icon">
                    <i class="fas fa-arrow-down"></i>
                </div>
                <a href="{{ route('financeiro.contas-receber.index') }}" class="small-box-footer">
                    Mais detalhes <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>R$ 0,00</h3>
                    <p>Contas a Pagar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-arrow-up"></i>
                </div>
                <a href="{{ route('financeiro.contas-pagar.index') }}" class="small-box-footer">
                    Mais detalhes <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>R$ 0,00</h3>
                    <p>Saldo</p>
                </div>
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <a href="{{ route('financeiro.conciliacoes-bancarias.index') }}" class="small-box-footer">
                    Conciliação Bancária <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success">
                    <h3 class="card-title"><i class="fas fa-money-bill-wave"></i> Contas a Receber</h3>
                    <div class="card-tools">
                        <a href="{{ route('financeiro.contas-receber.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Nova
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted">Gerenciar contas a receber</p>
                    <a href="{{ route('financeiro.contas-receber.index') }}" class="btn btn-success btn-block">
                        <i class="fas fa-list"></i> Ver Todas
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger">
                    <h3 class="card-title"><i class="fas fa-file-invoice-dollar"></i> Contas a Pagar</h3>
                    <div class="card-tools">
                        <a href="{{ route('financeiro.contas-pagar.create') }}" class="btn btn-danger btn-sm">
                            <i class="fas fa-plus"></i> Nova
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted">Gerenciar contas a pagar</p>
                    <a href="{{ route('financeiro.contas-pagar.index') }}" class="btn btn-danger btn-block">
                        <i class="fas fa-list"></i> Ver Todas
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
