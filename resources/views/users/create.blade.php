@extends('adminlte::page')

@section('title', 'Novo Usuário')

@section('content_header')
    <h1><i class="fas fa-user-plus"></i> Novo Usuário</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
        <li class="breadcrumb-item active">Novo</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cadastrar Novo Usuário</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}" id="create-form">
                @csrf

                <div class="row">
                    <!-- Nome -->
                    <div class="col-md-12 form-group">
                        <label for="name">Nome Completo <span class="text-danger">*</span></label>
                        <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Perfil -->
                    <div class="col-md-6 form-group">
                        <label for="role">Perfil</label>
                        <select id="role" name="role" class="form-control @error('role') is-invalid @enderror">
                            <option value="">Selecione um perfil</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Senha -->
                    <div class="col-md-6 form-group">
                        <label for="password">Senha <span class="text-danger">*</span></label>
                        <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirmar Senha -->
                    <div class="col-md-6 form-group">
                        <label for="password_confirmation">Confirmar Senha <span class="text-danger">*</span></label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <a href="{{ route('users.index') }}" class="btn btn-default">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
            <button type="submit" form="create-form" class="btn btn-success float-right">
                <i class="fas fa-save"></i> Cadastrar Usuário
            </button>
        </div>
    </div>
@stop
