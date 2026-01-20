@extends('adminlte::page')

@section('title', 'Detalhes da Empresa')

@section('content_header')
    <h1><i class="fas fa-building"></i> Detalhes da Empresa</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('empresas.index') }}">Empresas</a></li>
        <li class="breadcrumb-item active">Detalhes</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informações da Empresa</h3>
                    <div class="card-tools">
                        <a href="{{ route('empresas.edit', $empresa) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Nome Fantasia:</dt>
                        <dd class="col-sm-8">{{ $empresa->nome }}</dd>

                        <dt class="col-sm-4">Razão Social:</dt>
                        <dd class="col-sm-8">{{ $empresa->razao_social }}</dd>

                        <dt class="col-sm-4">CNPJ:</dt>
                        <dd class="col-sm-8">{{ $empresa->cnpj }}</dd>

                        <dt class="col-sm-4">Responsável:</dt>
                        <dd class="col-sm-8">{{ $empresa->responsavel ?? '-' }}</dd>

                        <dt class="col-sm-4">Email:</dt>
                        <dd class="col-sm-8">{{ $empresa->email ?? '-' }}</dd>

                        <dt class="col-sm-4">Telefone:</dt>
                        <dd class="col-sm-8">{{ $empresa->telefone ?? '-' }}</dd>

                        <dt class="col-sm-4">Celular:</dt>
                        <dd class="col-sm-8">{{ $empresa->celular ?? '-' }}</dd>

                        <dt class="col-sm-4">Status:</dt>
                        <dd class="col-sm-8">
                            @if($empresa->status == 'ativa')
                                <span class="badge badge-success">Ativa</span>
                            @else
                                <span class="badge badge-danger">Inativa</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Endereço:</dt>
                        <dd class="col-sm-8">
                            @if($empresa->endereco)
                                {{ $empresa->endereco }}{{ $empresa->numero ? ', ' . $empresa->numero : '' }}{{ $empresa->complemento ? ' - ' . $empresa->complemento : '' }}<br>
                                {{ $empresa->bairro }}<br>
                                {{ $empresa->cidade }} - {{ $empresa->estado }}<br>
                                CEP: {{ $empresa->cep }}
                            @else
                                -
                            @endif
                        </dd>

                        <dt class="col-sm-4">Observações:</dt>
                        <dd class="col-sm-8">{{ $empresa->observacoes ?? '-' }}</dd>

                        <dt class="col-sm-4">Cadastrado em:</dt>
                        <dd class="col-sm-8">{{ $empresa->created_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-4">Última atualização:</dt>
                        <dd class="col-sm-8">{{ $empresa->updated_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Alunos Vinculados</h3>
                </div>
                <div class="card-body p-0">
                    @if($empresa->alunos->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($empresa->alunos as $aluno)
                                <li class="list-group-item">
                                    <a href="{{ route('alunos.show', $aluno) }}">
                                        <i class="fas fa-user-graduate"></i> {{ $aluno->nome }}
                                    </a>
                                    <span class="badge badge-{{ $aluno->status == 'ativo' ? 'success' : 'secondary' }} float-right">
                                        {{ ucfirst($aluno->status) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center text-muted p-3">Nenhum aluno vinculado a esta empresa.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <a href="{{ route('empresas.index') }}" class="btn btn-default">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>
@stop
