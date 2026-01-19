@extends('adminlte::page')

@section('title', 'Editar Avaliação')

@section('content_header')
    <h1><i class="fas fa-clipboard-check"></i> Editar Avaliação</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('avaliacoes.update', $avaliacao) }}">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="disciplina_id">Disciplina <span class="text-danger">*</span></label>
                        <select id="disciplina_id" name="disciplina_id" class="form-control @error('disciplina_id') is-invalid @enderror" required>
                            @foreach($disciplinas ?? [] as $disciplina)
                                <option value="{{ $disciplina->id }}" {{ old('disciplina_id', $avaliacao->disciplina_id) == $disciplina->id ? 'selected' : '' }}>{{ $disciplina->nome }}</option>
                            @endforeach
                        </select>
                        @error('disciplina_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="turma_id">Turma <span class="text-danger">*</span></label>
                        <select id="turma_id" name="turma_id" class="form-control @error('turma_id') is-invalid @enderror" required>
                            @foreach($turmas ?? [] as $turma)
                                <option value="{{ $turma->id }}" {{ old('turma_id', $avaliacao->turma_id) == $turma->id ? 'selected' : '' }}>{{ $turma->nome }}</option>
                            @endforeach
                        </select>
                        @error('turma_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="tipo">Tipo <span class="text-danger">*</span></label>
                        <select id="tipo" name="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
                            <option value="prova" {{ old('tipo', $avaliacao->tipo) == 'prova' ? 'selected' : '' }}>Prova</option>
                            <option value="trabalho" {{ old('tipo', $avaliacao->tipo) == 'trabalho' ? 'selected' : '' }}>Trabalho</option>
                            <option value="seminario" {{ old('tipo', $avaliacao->tipo) == 'seminario' ? 'selected' : '' }}>Seminário</option>
                            <option value="atividade" {{ old('tipo', $avaliacao->tipo) == 'atividade' ? 'selected' : '' }}>Atividade</option>
                        </select>
                        @error('tipo')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="data_avaliacao">Data <span class="text-danger">*</span></label>
                        <input id="data_avaliacao" class="form-control @error('data_avaliacao') is-invalid @enderror" type="date" name="data_avaliacao" value="{{ old('data_avaliacao', $avaliacao->data_avaliacao?->format('Y-m-d')) }}" required>
                        @error('data_avaliacao')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="valor">Valor/Peso <span class="text-danger">*</span></label>
                        <input id="valor" class="form-control @error('valor') is-invalid @enderror" type="number" step="0.1" name="valor" value="{{ old('valor', $avaliacao->valor) }}" required>
                        @error('valor')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('avaliacoes.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Atualizar</button>
            </div>
        </form>
    </div>
@stop
