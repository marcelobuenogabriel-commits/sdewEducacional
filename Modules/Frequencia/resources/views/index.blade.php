@extends('adminlte::page')

@section('title', 'Frequência')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-calendar-check"></i> Frequência</h1>
        <a href="{{ route('frequencias.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Registrar Frequência
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
            <h3 class="card-title">Registros de Frequência</h3>
        </div>
        <div class="card-body">
            @if(isset($frequencias) && $frequencias->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Aluno</th>
                                <th>Disciplina</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th width="200">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($frequencias as $frequencia)
                                <tr>
                                    <td>{{ $frequencia->aluno?->nome ?? '-' }}</td>
                                    <td>{{ $frequencia->disciplina?->nome ?? '-' }}</td>
                                    <td>{{ $frequencia->data?->format('d/m/Y') ?? '-' }}</td>
                                    <td>
                                        @if($frequencia->presente ?? false)
                                            <span class="badge badge-success">Presente</span>
                                        @else
                                            <span class="badge badge-danger">Ausente</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('frequencias.show', $frequencia) }}" class="btn btn-info btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('frequencias.edit', $frequencia) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('frequencias.destroy', $frequencia) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir este registro?');">
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
                    {{ $frequencias->links() }}
                </div>
            @else
                <p class="text-muted">Nenhum registro de frequência encontrado.</p>
            @endif
        </div>
    </div>
@stop
