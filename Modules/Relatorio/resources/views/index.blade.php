@extends('adminlte::page')

@section('title', 'Relatórios')

@section('content_header')
    <h1><i class="fas fa-chart-bar"></i> Relatórios</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title"><i class="fas fa-user-graduate"></i> Relatórios de Alunos</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('relatorios.alunos') }}" class="btn btn-block btn-primary">
                        <i class="fas fa-file-pdf"></i> Relatório Geral de Alunos
                    </a>
                    <a href="{{ route('relatorios.alunos-turma') }}" class="btn btn-block btn-primary mt-2">
                        <i class="fas fa-file-pdf"></i> Alunos por Turma
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success">
                    <h3 class="card-title"><i class="fas fa-dollar-sign"></i> Relatórios Financeiros</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('relatorios.financeiro') }}" class="btn btn-block btn-success">
                        <i class="fas fa-file-pdf"></i> Relatório Financeiro
                    </a>
                    <a href="{{ route('relatorios.inadimplentes') }}" class="btn btn-block btn-success mt-2">
                        <i class="fas fa-file-pdf"></i> Alunos Inadimplentes
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title"><i class="fas fa-chart-line"></i> Relatórios Acadêmicos</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('relatorios.notas') }}" class="btn btn-block btn-info">
                        <i class="fas fa-file-pdf"></i> Boletim de Notas
                    </a>
                    <a href="{{ route('relatorios.frequencia') }}" class="btn btn-block btn-info mt-2">
                        <i class="fas fa-file-pdf"></i> Frequência
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
