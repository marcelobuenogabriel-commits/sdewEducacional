@extends('adminlte::page')

@section('title', 'Disciplinas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-book"></i> Disciplinas</h1>
        <a href="{{ route('disciplinas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Disciplina
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
            <h3 class="card-title">Lista de Disciplinas</h3>
        </div>
        <div class="card-body">
            @if(isset($disciplinas) && $disciplinas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Carga Horária</th>
                                <th>Professor</th>
                                <th>Status</th>
                                <th width="200">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($disciplinas as $disciplina)
                                <tr>
                                    <td>{{ $disciplina->codigo }}</td>
                                    <td>{{ $disciplina->nome }}</td>
                                    <td>{{ $disciplina->carga_horaria }}h</td>
                                    <td>{{ $disciplina->professor?->nome ?? '-' }}</td>
                                    <td>
                                        @if($disciplina->ativo)
                                            <span class="badge badge-success">Ativa</span>
                                        @else
                                            <span class="badge badge-danger">Inativa</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('disciplinas.show', $disciplina) }}" class="btn btn-info btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('disciplinas.edit', $disciplina) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('disciplinas.destroy', $disciplina) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir esta disciplina?');">
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
                    {{ $disciplinas->links() }}
                </div>
            @else
                <p class="text-muted">Nenhuma disciplina cadastrada.</p>
            @endif
        </div>
    </div>
@stop
