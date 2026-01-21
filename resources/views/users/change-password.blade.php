@extends('adminlte::page')

@section('title', 'Alterar Senha do Usuário')

@section('content_header')
    <h1><i class="fas fa-key"></i> Alterar Senha do Usuário</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
        <li class="breadcrumb-item active">Alterar Senha</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Alterar Senha de {{ $user->name }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.update-password', $user) }}" id="password-form">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Nova Senha -->
                    <div class="col-md-6 form-group">
                        <label for="password">Nova Senha <span class="text-danger">*</span></label>
                        <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autofocus>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">A senha deve ter no mínimo 8 caracteres.</small>
                    </div>

                    <!-- Confirmar Nova Senha -->
                    <div class="col-md-6 form-group">
                        <label for="password_confirmation">Confirmar Nova Senha <span class="text-danger">*</span></label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <a href="{{ route('users.index') }}" class="btn btn-default">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
            <button type="submit" form="password-form" class="btn btn-warning float-right">
                <i class="fas fa-key"></i> Alterar Senha
            </button>
        </div>
    </div>
@stop
