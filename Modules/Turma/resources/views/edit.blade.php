@extends('adminlte::page')

@section('title', 'Editar Turma')

@section('content_header')
    <h1><i class="fas fa-users"></i> Editar Turma</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('turmas.update', $turma) }}">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="nome">Nome da Turma <span class="text-danger">*</span></label>
                        <input id="nome" class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" value="{{ old('nome', $turma->nome) }}" required>
                        @error('nome')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="codigo">Código <span class="text-danger">*</span></label>
                        <input id="codigo" class="form-control @error('codigo') is-invalid @enderror" type="text" name="codigo" value="{{ old('codigo', $turma->codigo) }}" required>
                        @error('codigo')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="ano">Ano Letivo <span class="text-danger">*</span></label>
                        <input id="ano" class="form-control @error('ano') is-invalid @enderror" type="number" name="ano" value="{{ old('ano', $turma->ano) }}" required min="2000" max="2100">
                        @error('ano')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="periodo">Período <span class="text-danger">*</span></label>
                        <select id="periodo" name="periodo" class="form-control @error('periodo') is-invalid @enderror" required>
                            <option value="matutino" {{ old('periodo', $turma->periodo) == 'matutino' ? 'selected' : '' }}>Matutino</option>
                            <option value="vespertino" {{ old('periodo', $turma->periodo) == 'vespertino' ? 'selected' : '' }}>Vespertino</option>
                            <option value="noturno" {{ old('periodo', $turma->periodo) == 'noturno' ? 'selected' : '' }}>Noturno</option>
                            <option value="integral" {{ old('periodo', $turma->periodo) == 'integral' ? 'selected' : '' }}>Integral</option>
                        </select>
                        @error('periodo')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="vagas_total">Total de Vagas <span class="text-danger">*</span></label>
                        <input id="vagas_total" class="form-control @error('vagas_total') is-invalid @enderror" type="number" name="vagas_total" value="{{ old('vagas_total', $turma->vagas_total) }}" required min="1">
                        @error('vagas_total')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ativo" name="ativo" value="1" {{ old('ativo', $turma->ativo) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="ativo">Turma Ativa</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('turmas.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Atualizar</button>
            </div>
        </form>
    </div>
@stop
