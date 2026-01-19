@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-user-graduate"></i> Alunos</h1>
        <a href="{{ route('alunos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Aluno
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
            <h3 class="card-title">Lista de Alunos</h3>
        </div>
        <div class="card-body">
            @if($alunos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Matrícula</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Turma</th>
                                <th>Status</th>
                                <th width="200">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alunos as $aluno)
                                <tr>
                                    <td>{{ $aluno->matricula }}</td>
                                    <td>{{ $aluno->nome }}</td>
                                    <td>{{ $aluno->cpf }}</td>
                                    <td>{{ $aluno->email }}</td>
                                    <td>{{ $aluno->turma?->nome ?? '-' }}</td>
                                    <td>
                                        @if($aluno->status === 'ativo')
                                            <span class="badge badge-success">Ativo</span>
                                        @elseif($aluno->status === 'trancado')
                                            <span class="badge badge-warning">Trancado</span>
                                        @elseif($aluno->status === 'concluido')
                                            <span class="badge badge-info">Concluído</span>
                                        @else
                                            <span class="badge badge-danger">Inativo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('alunos.show', $aluno) }}" class="btn btn-info btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('alunos.edit', $aluno) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('alunos.destroy', $aluno) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir este aluno?');">
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
                    {{ $alunos->links() }}
                </div>
            @else
                <p class="text-muted">Nenhum aluno cadastrado.</p>
            @endif
        </div>
    </div>
@stop
