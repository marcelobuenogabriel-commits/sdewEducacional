@extends('adminlte::page')

@section('title', 'Novo Professor')

@section('content_header')
    <h1><i class="fas fa-chalkboard-teacher"></i> Novo Professor</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('professores.store') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="nome">Nome Completo <span class="text-danger">*</span></label>
                        <input id="nome" class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" value="{{ old('nome') }}" required>
                        @error('nome')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="cpf">CPF <span class="text-danger">*</span></label>
                        <input id="cpf" class="form-control @error('cpf') is-invalid @enderror" type="text" name="cpf" value="{{ old('cpf') }}" required>
                        @error('cpf')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required>
                        @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="telefone">Telefone</label>
                        <input id="telefone" class="form-control @error('telefone') is-invalid @enderror" type="text" name="telefone" value="{{ old('telefone') }}">
                        @error('telefone')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="especialidade">Especialidade</label>
                        <input id="especialidade" class="form-control @error('especialidade') is-invalid @enderror" type="text" name="especialidade" value="{{ old('especialidade') }}">
                        @error('especialidade')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('professores.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Cadastrar</button>
            </div>
        </form>
    </div>
@stop
