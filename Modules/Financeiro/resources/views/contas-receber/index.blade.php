@extends('adminlte::page')

@section('title', 'Contas a Receber')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-money-bill-wave"></i> Contas a Receber</h1>
        <a href="{{ route('financeiro.contas-receber.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Conta
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
            <h3 class="card-title">Lista de Contas a Receber</h3>
        </div>
        <div class="card-body">
            @if(isset($contasReceber) && $contasReceber->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Cliente/Aluno</th>
                                <th>Valor</th>
                                <th>Vencimento</th>
                                <th>Status</th>
                                <th width="200">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contasReceber as $conta)
                                <tr>
                                    <td>{{ $conta->descricao ?? '-' }}</td>
                                    <td>{{ $conta->cliente ?? '-' }}</td>
                                    <td>R$ {{ number_format($conta->valor ?? 0, 2, ',', '.') }}</td>
                                    <td>{{ $conta->data_vencimento?->format('d/m/Y') ?? '-' }}</td>
                                    <td>
                                        @if($conta->recebido ?? false)
                                            <span class="badge badge-success">Recebido</span>
                                        @elseif($conta->data_vencimento < now())
                                            <span class="badge badge-danger">Vencido</span>
                                        @else
                                            <span class="badge badge-warning">Pendente</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('financeiro.contas-receber.show', $conta) }}" class="btn btn-info btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('financeiro.contas-receber.edit', $conta) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('financeiro.contas-receber.destroy', $conta) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza?');">
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
                    {{ $contasReceber->links() }}
                </div>
            @else
                <p class="text-muted">Nenhuma conta a receber cadastrada.</p>
            @endif
        </div>
    </div>
@stop
