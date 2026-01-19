@extends('adminlte::page')

@section('title', 'Novo Aluno')

@section('content_header')
    <h1><i class="fas fa-user-graduate"></i> Novo Aluno</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('alunos.index') }}">Alunos</a></li>
        <li class="breadcrumb-item active">Novo</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cadastrar Novo Aluno</h3>
        </div>
        <div class="card-body">
                    <form method="POST" action="{{ route('alunos.store') }}">
                        @csrf

                        <div class="row">
                            <!-- Nome -->
                            <div class="col-md-12 form-group">
                                <label for="nome">Nome Completo <span class="text-danger">*</span></label>
                                <input id="nome" class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" value="{{ old('nome') }}" required autofocus>
                                @error('nome')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- CPF -->
                            <div class="col-md-6 form-group">
                                <label for="cpf">CPF <span class="text-danger">*</span></label>
                                <input id="cpf" class="form-control @error('cpf') is-invalid @enderror" type="text" name="cpf" value="{{ old('cpf') }}" required placeholder="000.000.000-00">
                                @error('cpf')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- RG -->
                            <div class="col-md-6 form-group">
                                <label for="rg">RG</label>
                                <input id="rg" class="form-control @error('rg') is-invalid @enderror" type="text" name="rg" value="{{ old('rg') }}">
                                @error('rg')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Data de Nascimento -->
                            <div class="col-md-6 form-group">
                                <label for="data_nascimento">Data de Nascimento <span class="text-danger">*</span></label>
                                <input id="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror" type="date" name="data_nascimento" value="{{ old('data_nascimento') }}" required>
                                @error('data_nascimento')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Matrícula -->
                            <div class="col-md-6 form-group">
                                <label for="matricula">Matrícula <span class="text-danger">*</span></label>
                                <input id="matricula" class="form-control @error('matricula') is-invalid @enderror" type="text" name="matricula" value="{{ old('matricula') }}" required>
                                @error('matricula')
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

                            <!-- Telefone -->
                            <div class="col-md-6 form-group">
                                <label for="telefone">Telefone</label>
                                <input id="telefone" class="form-control @error('telefone') is-invalid @enderror" type="text" name="telefone" value="{{ old('telefone') }}" placeholder="(00) 0000-0000">
                                @error('telefone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Celular -->
                            <div class="col-md-6 form-group">
                                <label for="celular">Celular</label>
                                <input id="celular" class="form-control @error('celular') is-invalid @enderror" type="text" name="celular" value="{{ old('celular') }}" placeholder="(00) 00000-0000">
                                @error('celular')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Turma -->
                            <div class="col-md-6 form-group">
                                <label for="turma_id">Turma</label>
                                <select id="turma_id" name="turma_id" class="form-control @error('turma_id') is-invalid @enderror">
                                    <option value="">Selecione uma turma</option>
                                    @foreach($turmas as $turma)
                                        <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>
                                            {{ $turma->nome }} - {{ $turma->codigo }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('turma_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Endereço -->
                            <div class="col-md-12 form-group">
                                <label for="endereco">Endereço</label>
                                <input id="endereco" class="form-control @error('endereco') is-invalid @enderror" type="text" name="endereco" value="{{ old('endereco') }}">
                                @error('endereco')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Número -->
                            <div class="col-md-4 form-group">
                                <label for="numero">Número</label>
                                <input id="numero" class="form-control @error('numero') is-invalid @enderror" type="text" name="numero" value="{{ old('numero') }}">
                                @error('numero')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Complemento -->
                            <div class="col-md-4 form-group">
                                <label for="complemento">Complemento</label>
                                <input id="complemento" class="form-control @error('complemento') is-invalid @enderror" type="text" name="complemento" value="{{ old('complemento') }}">
                                @error('complemento')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Bairro -->
                            <div class="col-md-4 form-group">
                                <label for="bairro">Bairro</label>
                                <input id="bairro" class="form-control @error('bairro') is-invalid @enderror" type="text" name="bairro" value="{{ old('bairro') }}">
                                @error('bairro')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Cidade -->
                            <div class="col-md-4 form-group">
                                <label for="cidade">Cidade</label>
                                <input id="cidade" class="form-control @error('cidade') is-invalid @enderror" type="text" name="cidade" value="{{ old('cidade') }}">
                                @error('cidade')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Estado -->
                            <div class="col-md-4 form-group">
                                <label for="estado">Estado (UF)</label>
                                <input id="estado" class="form-control @error('estado') is-invalid @enderror" type="text" name="estado" value="{{ old('estado') }}" maxlength="2" placeholder="SP">
                                @error('estado')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- CEP -->
                            <div class="col-md-4 form-group">
                                <label for="cep">CEP</label>
                                <input id="cep" class="form-control @error('cep') is-invalid @enderror" type="text" name="cep" value="{{ old('cep') }}" placeholder="00000-000">
                                @error('cep')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Observações -->
                            <div class="col-md-12 form-group">
                                <label for="observacoes">Observações</label>
                                <textarea id="observacoes" name="observacoes" rows="3" class="form-control @error('observacoes') is-invalid @enderror">{{ old('observacoes') }}</textarea>
                                @error('observacoes')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('alunos.index') }}" class="btn btn-default">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" form="create-form" class="btn btn-success float-right">
                        <i class="fas fa-save"></i> Cadastrar Aluno
                    </button>
                </div>
            </div>

            <script>
                document.querySelector('form').id = 'create-form';
            </script>
@stop
