@extends('adminlte::page')

@section('title', 'Conciliação Bancária')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-university"></i> Conciliação Bancária</h1>
        <a href="{{ route('financeiro.conciliacoes-bancarias.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Conciliação
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
            <h3 class="card-title">Lista de Conciliações</h3>
        </div>
        <div class="card-body">
            @if(isset($conciliacoes) && $conciliacoes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Banco</th>
                                <th>Saldo Inicial</th>
                                <th>Saldo Final</th>
                                <th>Status</th>
                                <th width="200">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($conciliacoes as $conciliacao)
                                <tr>
                                    <td>{{ $conciliacao->data?->format('d/m/Y') ?? '-' }}</td>
                                    <td>{{ $conciliacao->banco ?? '-' }}</td>
                                    <td>R$ {{ number_format($conciliacao->saldo_inicial ?? 0, 2, ',', '.') }}</td>
                                    <td>R$ {{ number_format($conciliacao->saldo_final ?? 0, 2, ',', '.') }}</td>
                                    <td>
                                        @if($conciliacao->conciliado ?? false)
                                            <span class="badge badge-success">Conciliado</span>
                                        @else
                                            <span class="badge badge-warning">Pendente</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('financeiro.conciliacoes-bancarias.show', $conciliacao) }}" class="btn btn-info btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('financeiro.conciliacoes-bancarias.edit', $conciliacao) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('financeiro.conciliacoes-bancarias.destroy', $conciliacao) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza?');">
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
                    {{ $conciliacoes->links() }}
                </div>
            @else
                <p class="text-muted">Nenhuma conciliação cadastrada.</p>
            @endif
        </div>
    </div>
@stop
