@extends('adminlte::page')

@section('title', 'Nova Matrícula')

@section('content_header')
    <h1><i class="fas fa-file-signature"></i> Nova Matrícula</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('matriculas.store') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="aluno_id">Aluno <span class="text-danger">*</span></label>
                        <select id="aluno_id" name="aluno_id" class="form-control @error('aluno_id') is-invalid @enderror" required>
                            <option value="">Selecione o aluno</option>
                            @foreach($alunos as $aluno)
                                <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>
                                    {{ $aluno->nome }} - {{ $aluno->matricula }}
                                </option>
                            @endforeach
                        </select>
                        @error('aluno_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="turma_id">Turma <span class="text-danger">*</span></label>
                        <select id="turma_id" name="turma_id" class="form-control @error('turma_id') is-invalid @enderror" required>
                            <option value="">Selecione a turma</option>
                            @foreach($turmas as $turma)
                                <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>
                                    {{ $turma->nome }} - {{ $turma->codigo }}
                                </option>
                            @endforeach
                        </select>
                        @error('turma_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="data_matricula">Data da Matrícula <span class="text-danger">*</span></label>
                        <input id="data_matricula" class="form-control @error('data_matricula') is-invalid @enderror" type="date" name="data_matricula" value="{{ old('data_matricula', date('Y-m-d')) }}" required>
                        @error('data_matricula')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="data_inicio">Data de Início <span class="text-danger">*</span></label>
                        <input id="data_inicio" class="form-control @error('data_inicio') is-invalid @enderror" type="date" name="data_inicio" value="{{ old('data_inicio', date('Y-m-d')) }}" required>
                        @error('data_inicio')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="data_fim">Data de Término <span class="text-danger">*</span></label>
                        <input id="data_fim" class="form-control @error('data_fim') is-invalid @enderror" type="date" name="data_fim" value="{{ old('data_fim') }}" required>
                        @error('data_fim')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="valor_mensalidade">Valor da Mensalidade <span class="text-danger">*</span></label>
                        <input id="valor_mensalidade" class="form-control @error('valor_mensalidade') is-invalid @enderror" type="text" name="valor_mensalidade" value="{{ old('valor_mensalidade') }}" required data-mask="currency" placeholder="R$ 0,00">
                        @error('valor_mensalidade')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="numero_parcelas">Número de Parcelas <span class="text-danger">*</span></label>
                        <input id="numero_parcelas" class="form-control @error('numero_parcelas') is-invalid @enderror" type="number" name="numero_parcelas" value="{{ old('numero_parcelas', 12) }}" required min="1" max="24">
                        @error('numero_parcelas')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="observacoes">Observações</label>
                        <textarea id="observacoes" name="observacoes" rows="3" class="form-control @error('observacoes') is-invalid @enderror">{{ old('observacoes') }}</textarea>
                        @error('observacoes')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('matriculas.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Cadastrar</button>
            </div>
        </form>
    </div>
@stop
