@extends('adminlte::page')

@section('title', 'Editar Professor')

@section('content_header')
    <h1><i class="fas fa-chalkboard-teacher"></i> Editar Professor</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('professores.update', $professor) }}">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="nome">Nome Completo <span class="text-danger">*</span></label>
                        <input id="nome" class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" value="{{ old('nome', $professor->nome) }}" required>
                        @error('nome')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="cpf">CPF <span class="text-danger">*</span></label>
                        <input id="cpf" class="form-control @error('cpf') is-invalid @enderror" type="text" name="cpf" value="{{ old('cpf', $professor->cpf) }}" required>
                        @error('cpf')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', $professor->email) }}" required>
                        @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="telefone">Telefone</label>
                        <input id="telefone" class="form-control @error('telefone') is-invalid @enderror" type="text" name="telefone" value="{{ old('telefone', $professor->telefone) }}">
                        @error('telefone')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="especialidade">Especialidade</label>
                        <input id="especialidade" class="form-control @error('especialidade') is-invalid @enderror" type="text" name="especialidade" value="{{ old('especialidade', $professor->especialidade) }}">
                        @error('especialidade')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ativo" name="ativo" value="1" {{ old('ativo', $professor->ativo) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="ativo">Professor Ativo</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('professores.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Atualizar</button>
            </div>
        </form>
    </div>
@stop
