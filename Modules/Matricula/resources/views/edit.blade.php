@extends('adminlte::page')

@section('title', 'Editar Matrícula')

@section('content_header')
    <h1><i class="fas fa-file-signature"></i> Editar Matrícula</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('matriculas.update', $matricula) }}">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="aluno_id">Aluno <span class="text-danger">*</span></label>
                        <select id="aluno_id" name="aluno_id" class="form-control @error('aluno_id') is-invalid @enderror" required>
                            @foreach($alunos as $aluno)
                                <option value="{{ $aluno->id }}" {{ old('aluno_id', $matricula->aluno_id) == $aluno->id ? 'selected' : '' }}>
                                    {{ $aluno->nome }} - {{ $aluno->matricula }}
                                </option>
                            @endforeach
                        </select>
                        @error('aluno_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="turma_id">Turma <span class="text-danger">*</span></label>
                        <select id="turma_id" name="turma_id" class="form-control @error('turma_id') is-invalid @enderror" required>
                            @foreach($turmas as $turma)
                                <option value="{{ $turma->id }}" {{ old('turma_id', $matricula->turma_id) == $turma->id ? 'selected' : '' }}>
                                    {{ $turma->nome }} - {{ $turma->codigo }}
                                </option>
                            @endforeach
                        </select>
                        @error('turma_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="data_matricula">Data da Matrícula <span class="text-danger">*</span></label>
                        <input id="data_matricula" class="form-control @error('data_matricula') is-invalid @enderror" type="date" name="data_matricula" value="{{ old('data_matricula', $matricula->data_matricula->format('Y-m-d')) }}" required>
                        @error('data_matricula')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="valor_mensalidade">Valor da Mensalidade <span class="text-danger">*</span></label>
                        <input id="valor_mensalidade" class="form-control @error('valor_mensalidade') is-invalid @enderror" type="text" name="valor_mensalidade" value="{{ old('valor_mensalidade', number_format($matricula->valor_mensalidade, 2, ',', '.')) }}" required data-mask="currency" placeholder="R$ 0,00">
                        @error('valor_mensalidade')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="ativo" {{ old('status', $matricula->status) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                            <option value="cancelado" {{ old('status', $matricula->status) == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            <option value="transferido" {{ old('status', $matricula->status) == 'transferido' ? 'selected' : '' }}>Transferido</option>
                            <option value="concluido" {{ old('status', $matricula->status) == 'concluido' ? 'selected' : '' }}>Concluído</option>
                        </select>
                        @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('matriculas.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Atualizar</button>
            </div>
        </form>
    </div>
@stop
