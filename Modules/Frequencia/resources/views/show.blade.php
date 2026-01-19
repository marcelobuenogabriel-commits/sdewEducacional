@extends('adminlte::page')

@section('title', 'Detalhes da Frequência')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-calendar-check"></i> Detalhes da Frequência</h1>
        <div>
            <a href="{{ route('frequencias.edit', $frequencia) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
            <a href="{{ route('frequencias.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-user"></i> Aluno</strong>
                    <p class="text-muted">{{ $frequencia->aluno?->nome ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-book"></i> Disciplina</strong>
                    <p class="text-muted">{{ $frequencia->disciplina?->nome ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-calendar"></i> Data</strong>
                    <p class="text-muted">{{ $frequencia->data?->format('d/m/Y') ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-check-circle"></i> Status</strong>
                    <p>
                        @if($frequencia->presente ?? false)
                            <span class="badge badge-success">Presente</span>
                        @else
                            <span class="badge badge-danger">Ausente</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
