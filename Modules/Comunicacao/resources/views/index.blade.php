@extends('adminlte::page')

@section('title', 'Comunicação')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-envelope"></i> Comunicação</h1>
        <a href="{{ route('comunicacoes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Comunicação
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
            <h3 class="card-title">Lista de Comunicações</h3>
        </div>
        <div class="card-body">
            @if(isset($comunicacoes) && $comunicacoes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Tipo</th>
                                <th>Destinatário</th>
                                <th>Data de Envio</th>
                                <th>Status</th>
                                <th width="200">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comunicacoes as $comunicacao)
                                <tr>
                                    <td>{{ $comunicacao->titulo ?? '-' }}</td>
                                    <td>{{ ucfirst($comunicacao->tipo ?? 'email') }}</td>
                                    <td>{{ $comunicacao->destinatario ?? '-' }}</td>
                                    <td>{{ $comunicacao->data_envio?->format('d/m/Y H:i') ?? '-' }}</td>
                                    <td>
                                        @if($comunicacao->enviado ?? false)
                                            <span class="badge badge-success">Enviado</span>
                                        @else
                                            <span class="badge badge-warning">Pendente</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('comunicacoes.show', $comunicacao) }}" class="btn btn-info btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('comunicacoes.edit', $comunicacao) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('comunicacoes.destroy', $comunicacao) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir esta comunicação?');">
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
                    {{ $comunicacoes->links() }}
                </div>
            @else
                <p class="text-muted">Nenhuma comunicação cadastrada.</p>
            @endif
        </div>
    </div>
@stop
