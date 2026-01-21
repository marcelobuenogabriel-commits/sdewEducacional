@extends('adminlte::page')

@section('title', 'Detalhes do Usuário')

@section('content_header')
    <h1><i class="fas fa-user"></i> Detalhes do Usuário</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
        <li class="breadcrumb-item active">Detalhes</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informações do Usuário</h3>
            <div class="card-tools">
                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Editar
                </a>
            </div>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nome:</dt>
                <dd class="col-sm-9">{{ $user->name }}</dd>

                <dt class="col-sm-3">Email:</dt>
                <dd class="col-sm-9">{{ $user->email }}</dd>

                <dt class="col-sm-3">Perfil:</dt>
                <dd class="col-sm-9">
                    @if($user->roles->count() > 0)
                        @foreach($user->roles as $role)
                            <span class="badge badge-primary">{{ ucfirst($role->name) }}</span>
                        @endforeach
                    @else
                        <span class="badge badge-secondary">Nenhum perfil atribuído</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Email Verificado:</dt>
                <dd class="col-sm-9">
                    @if($user->email_verified_at)
                        <span class="badge badge-success">
                            <i class="fas fa-check"></i> Verificado em {{ $user->email_verified_at->format('d/m/Y H:i') }}
                        </span>
                    @else
                        <span class="badge badge-warning">
                            <i class="fas fa-times"></i> Não verificado
                        </span>
                    @endif
                </dd>

                <dt class="col-sm-3">Cadastrado em:</dt>
                <dd class="col-sm-9">{{ $user->created_at->format('d/m/Y H:i') }}</dd>

                <dt class="col-sm-3">Última atualização:</dt>
                <dd class="col-sm-9">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>
            </dl>
        </div>
        <div class="card-footer">
            <a href="{{ route('users.index') }}" class="btn btn-default">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            <a href="{{ route('users.change-password', $user) }}" class="btn btn-warning float-right">
                <i class="fas fa-key"></i> Trocar Senha
            </a>
        </div>
    </div>
@stop
