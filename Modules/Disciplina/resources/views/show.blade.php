@extends('adminlte::page')

@section('title', 'Detalhes da Disciplina')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-book"></i> Detalhes da Disciplina</h1>
        <div>
            <a href="{{ route('disciplinas.edit', $disciplina) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
            <a href="{{ route('disciplinas.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-barcode"></i> Código</strong>
                    <p class="text-muted">{{ $disciplina->codigo }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-book"></i> Nome</strong>
                    <p class="text-muted">{{ $disciplina->nome }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-clock"></i> Carga Horária</strong>
                    <p class="text-muted">{{ $disciplina->carga_horaria }}h</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-chalkboard-teacher"></i> Professor</strong>
                    <p class="text-muted">{{ $disciplina->professor?->nome ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-flag"></i> Status</strong>
                    <p>
                        @if($disciplina->ativo)
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
