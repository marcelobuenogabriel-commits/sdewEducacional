@extends('adminlte::page')

@section('title', 'Nova Disciplina')

@section('content_header')
    <h1><i class="fas fa-book"></i> Nova Disciplina</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('disciplinas.store') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="codigo">Código <span class="text-danger">*</span></label>
                        <input id="codigo" class="form-control @error('codigo') is-invalid @enderror" type="text" name="codigo" value="{{ old('codigo') }}" required>
                        @error('codigo')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="nome">Nome <span class="text-danger">*</span></label>
                        <input id="nome" class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" value="{{ old('nome') }}" required>
                        @error('nome')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="carga_horaria">Carga Horária <span class="text-danger">*</span></label>
                        <input id="carga_horaria" class="form-control @error('carga_horaria') is-invalid @enderror" type="number" name="carga_horaria" value="{{ old('carga_horaria') }}" required>
                        @error('carga_horaria')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="professor_id">Professor</label>
                        <select id="professor_id" name="professor_id" class="form-control @error('professor_id') is-invalid @enderror">
                            <option value="">Selecione</option>
                            @foreach($professores ?? [] as $professor)
                                <option value="{{ $professor->id }}">{{ $professor->nome }}</option>
                            @endforeach
                        </select>
                        @error('professor_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('disciplinas.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Cadastrar</button>
            </div>
        </form>
    </div>
@stop
