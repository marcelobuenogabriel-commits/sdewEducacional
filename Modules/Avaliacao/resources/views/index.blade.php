@extends('adminlte::page')

@section('title', 'Avaliações')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-clipboard-check"></i> Avaliações</h1>
        <a href="{{ route('avaliacoes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Avaliação
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
            <h3 class="card-title">Lista de Avaliações</h3>
        </div>
        <div class="card-body">
            @if(isset($avaliacoes) && $avaliacoes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Disciplina</th>
                                <th>Turma</th>
                                <th>Tipo</th>
                                <th>Data</th>
                                <th>Valor</th>
                                <th width="200">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($avaliacoes as $avaliacao)
                                <tr>
                                    <td>{{ $avaliacao->disciplina?->nome ?? '-' }}</td>
                                    <td>{{ $avaliacao->turma?->nome ?? '-' }}</td>
                                    <td>{{ ucfirst($avaliacao->tipo ?? 'prova') }}</td>
                                    <td>{{ $avaliacao->data_avaliacao?->format('d/m/Y') ?? '-' }}</td>
                                    <td>{{ $avaliacao->valor ?? '0' }}</td>
                                    <td>
                                        <a href="{{ route('avaliacoes.show', $avaliacao) }}" class="btn btn-info btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('avaliacoes.edit', $avaliacao) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('avaliacoes.destroy', $avaliacao) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir esta avaliação?');">
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
                    {{ $avaliacoes->links() }}
                </div>
            @else
                <p class="text-muted">Nenhuma avaliação cadastrada.</p>
            @endif
        </div>
    </div>
@stop
