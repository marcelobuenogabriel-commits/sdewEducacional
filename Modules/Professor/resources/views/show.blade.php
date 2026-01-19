@extends('adminlte::page')

@section('title', 'Detalhes do Professor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-chalkboard-teacher"></i> Detalhes do Professor</h1>
        <div>
            <a href="{{ route('professores.edit', $professor) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
            <a href="{{ route('professores.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-user"></i> Nome</strong>
                    <p class="text-muted">{{ $professor->nome }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-id-card"></i> CPF</strong>
                    <p class="text-muted">{{ $professor->cpf }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-envelope"></i> Email</strong>
                    <p class="text-muted">{{ $professor->email }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-phone"></i> Telefone</strong>
                    <p class="text-muted">{{ $professor->telefone ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-graduation-cap"></i> Especialidade</strong>
                    <p class="text-muted">{{ $professor->especialidade ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-flag"></i> Status</strong>
                    <p>
                        @if($professor->ativo)
                            <span class="badge badge-success">Ativo</span>
                        @else
                            <span class="badge badge-danger">Inativo</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
