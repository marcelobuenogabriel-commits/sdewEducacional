@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('page_header')
    <h1>Dashboard</h1>
@stop

@section('page_content')
    <!-- Stats Cards -->
    <div class="row">
        <!-- Total de Alunos -->
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['total_alunos'] }}</h3>
                    <p>Total de Alunos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <a href="{{ route('alunos.index') }}" class="small-box-footer">
                    Ver todos <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Total de Turmas -->
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['total_turmas'] }}</h3>
                    <p>Total de Turmas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('turmas.index') }}" class="small-box-footer">
                    Ver todas <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Alunos Ativos -->
        <div class="col-lg-4 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $stats['alunos_ativos'] }}</h3>
                    <p>Alunos Ativos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="small-box-footer">
                    {{ $stats['percentual_ativos'] }}% do total
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bolt"></i>
                        Ações Rápidas
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('alunos.create') }}" class="btn btn-app btn-primary btn-block">
                                <i class="fas fa-user-plus"></i> Cadastrar Novo Aluno
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('turmas.create') }}" class="btn btn-app btn-success btn-block">
                                <i class="fas fa-plus-circle"></i> Criar Nova Turma
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-home"></i>
                        Bem-vindo ao Sistema Sdew Educacional
                    </h3>
                </div>
                <div class="card-body">
                    <p>Você está autenticado como <strong>{{ Auth::user()->name }}</strong>.</p>
                    <p>Use o menu lateral para acessar os diferentes módulos do sistema.</p>
                </div>
            </div>
        </div>
    </div>
@stop

