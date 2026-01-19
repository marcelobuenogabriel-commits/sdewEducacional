@extends('adminlte::page')

@section('title', 'Turmas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-users"></i> Turmas</h1>
        <a href="{{ route('turmas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Turma
        </a>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Turmas</h3>
        </div>
        <div class="card-body">
            @if($turmas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Ano</th>
                                <th>Período</th>
                                <th>Vagas</th>
                                <th>Status</th>
                                <th width="200">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($turmas as $turma)
                                <tr>
                                    <td>{{ $turma->codigo }}</td>
                                    <td>{{ $turma->nome }}</td>
                                    <td>{{ $turma->ano }}</td>
                                    <td>{{ ucfirst($turma->periodo) }}</td>
                                    <td>
                                        {{ $turma->vagas_ocupadas }} / {{ $turma->vagas_total }}
                                        @if($turma->vagas_ocupadas >= $turma->vagas_total)
                                            <span class="badge badge-danger">Lotada</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($turma->ativo)
                                            <span class="badge badge-success">Ativa</span>
                                        @else
                                            <span class="badge badge-danger">Inativa</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('turmas.show', $turma) }}" class="btn btn-info btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('turmas.edit', $turma) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('turmas.destroy', $turma) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir esta turma?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $turmas->links() }}
                </div>
            @else
                <p class="text-muted">Nenhuma turma cadastrada.</p>
            @endif
        </div>
    </div>
@stop
