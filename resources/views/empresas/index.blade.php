@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <h1><i class="fas fa-building"></i> Empresas</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Empresas</h3>
            <div class="card-tools">
                <a href="{{ route('empresas.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Nova Empresa
                </a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Cidade</th>
                        <th>Responsável</th>
                        <th>Status</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($empresas as $empresa)
                        <tr>
                            <td>{{ $empresa->id }}</td>
                            <td>{{ $empresa->nome }}</td>
                            <td>{{ $empresa->cnpj }}</td>
                            <td>{{ $empresa->cidade }}</td>
                            <td>{{ $empresa->responsavel }}</td>
                            <td>
                                @if($empresa->status == 'ativa')
                                    <span class="badge badge-success">Ativa</span>
                                @else
                                    <span class="badge badge-danger">Inativa</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('empresas.show', $empresa) }}" class="btn btn-info btn-sm" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('empresas.edit', $empresa) }}" class="btn btn-primary btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('empresas.destroy', $empresa) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta empresa?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Nenhuma empresa cadastrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($empresas->hasPages())
            <div class="card-footer clearfix">
                {{ $empresas->links() }}
            </div>
        @endif
    </div>
@stop
