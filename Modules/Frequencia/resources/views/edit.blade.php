@extends('adminlte::page')

@section('title', 'Editar Frequência')

@section('content_header')
    <h1><i class="fas fa-calendar-check"></i> Editar Frequência</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('frequencias.update', $frequencia) }}">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="aluno_id">Aluno <span class="text-danger">*</span></label>
                        <select id="aluno_id" name="aluno_id" class="form-control @error('aluno_id') is-invalid @enderror" required>
                            @foreach($alunos ?? [] as $aluno)
                                <option value="{{ $aluno->id }}" {{ old('aluno_id', $frequencia->aluno_id) == $aluno->id ? 'selected' : '' }}>{{ $aluno->nome }}</option>
                            @endforeach
                        </select>
                        @error('aluno_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="disciplina_id">Disciplina <span class="text-danger">*</span></label>
                        <select id="disciplina_id" name="disciplina_id" class="form-control @error('disciplina_id') is-invalid @enderror" required>
                            @foreach($disciplinas ?? [] as $disciplina)
                                <option value="{{ $disciplina->id }}" {{ old('disciplina_id', $frequencia->disciplina_id) == $disciplina->id ? 'selected' : '' }}>{{ $disciplina->nome }}</option>
                            @endforeach
                        </select>
                        @error('disciplina_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="data">Data <span class="text-danger">*</span></label>
                        <input id="data" class="form-control @error('data') is-invalid @enderror" type="date" name="data" value="{{ old('data', $frequencia->data?->format('Y-m-d')) }}" required>
                        @error('data')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="custom-control custom-checkbox mt-4">
                            <input type="checkbox" class="custom-control-input" id="presente" name="presente" value="1" {{ old('presente', $frequencia->presente) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="presente">Presente</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('frequencias.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Atualizar</button>
            </div>
        </form>
    </div>
@stop
