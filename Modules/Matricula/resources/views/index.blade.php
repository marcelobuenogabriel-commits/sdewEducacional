@extends('adminlte::page')

@section('title', 'Matrículas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-file-signature"></i> Matrículas</h1>
        <a href="{{ route('matriculas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Matrícula
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
            <h3 class="card-title">Lista de Matrículas</h3>
        </div>
        <div class="card-body">
            @if($matriculas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Aluno</th>
                                <th>Turma</th>
                                <th>Data Matrícula</th>
                                <th>Valor Mensalidade</th>
                                <th>Status</th>
                                <th width="200">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($matriculas as $matricula)
                                <tr>
                                    <td>#{{ $matricula->id }}</td>
                                    <td>{{ $matricula->aluno?->nome ?? '-' }}</td>
                                    <td>{{ $matricula->turma?->nome ?? '-' }}</td>
                                    <td>{{ $matricula->data_matricula->format('d/m/Y') }}</td>
                                    <td>R$ {{ number_format($matricula->valor_mensalidade, 2, ',', '.') }}</td>
                                    <td>
                                        @if($matricula->status === 'ativo')
                                            <span class="badge badge-success">Ativo</span>
                                        @elseif($matricula->status === 'cancelado')
                                            <span class="badge badge-danger">Cancelado</span>
                                        @elseif($matricula->status === 'transferido')
                                            <span class="badge badge-warning">Transferido</span>
                                        @else
                                            <span class="badge badge-info">Concluído</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('matriculas.show', $matricula) }}" class="btn btn-info btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('matriculas.edit', $matricula) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('matriculas.destroy', $matricula) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir esta matrícula?');">
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
                    {{ $matriculas->links() }}
                </div>
            @else
                <p class="text-muted">Nenhuma matrícula cadastrada.</p>
            @endif
        </div>
    </div>
@stop
