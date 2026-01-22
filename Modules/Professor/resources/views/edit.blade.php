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
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h5><i class="icon fas fa-ban"></i> Erro!</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <h5 class="mb-3">Dados Pessoais</h5>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="nome">Nome Completo <span class="text-danger">*</span></label>
                        <input id="nome" class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" value="{{ old('nome', $professor->nome) }}" required>
                        @error('nome')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="cpf">CPF <span class="text-danger">*</span></label>
                        <input id="cpf" class="form-control @error('cpf') is-invalid @enderror" type="text" name="cpf" value="{{ old('cpf', $professor->cpf) }}" required maxlength="14" placeholder="000.000.000-00">
                        @error('cpf')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="rg">RG</label>
                        <input id="rg" class="form-control @error('rg') is-invalid @enderror" type="text" name="rg" value="{{ old('rg', $professor->rg) }}" maxlength="20">
                        @error('rg')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="data_nascimento">Data de Nascimento <span class="text-danger">*</span></label>
                        <input id="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror" type="date" name="data_nascimento" value="{{ old('data_nascimento', $professor->data_nascimento?->format('Y-m-d')) }}" required>
                        @error('data_nascimento')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>

                <h5 class="mb-3 mt-3">Contato</h5>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', $professor->email) }}" required>
                        @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="telefone">Telefone</label>
                        <input id="telefone" class="form-control @error('telefone') is-invalid @enderror" type="text" name="telefone" value="{{ old('telefone', $professor->telefone) }}" maxlength="20" placeholder="(00) 0000-0000">
                        @error('telefone')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="celular">Celular</label>
                        <input id="celular" class="form-control @error('celular') is-invalid @enderror" type="text" name="celular" value="{{ old('celular', $professor->celular) }}" maxlength="20" placeholder="(00) 00000-0000">
                        @error('celular')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>

                <h5 class="mb-3 mt-3">Endereço</h5>
                <div class="row">
                    <div class="col-md-8 form-group">
                        <label for="endereco">Endereço</label>
                        <input id="endereco" class="form-control @error('endereco') is-invalid @enderror" type="text" name="endereco" value="{{ old('endereco', $professor->endereco) }}">
                        @error('endereco')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="numero">Número</label>
                        <input id="numero" class="form-control @error('numero') is-invalid @enderror" type="text" name="numero" value="{{ old('numero', $professor->numero) }}" maxlength="10">
                        @error('numero')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="complemento">Complemento</label>
                        <input id="complemento" class="form-control @error('complemento') is-invalid @enderror" type="text" name="complemento" value="{{ old('complemento', $professor->complemento) }}">
                        @error('complemento')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="bairro">Bairro</label>
                        <input id="bairro" class="form-control @error('bairro') is-invalid @enderror" type="text" name="bairro" value="{{ old('bairro', $professor->bairro) }}">
                        @error('bairro')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="cep">CEP</label>
                        <input id="cep" class="form-control @error('cep') is-invalid @enderror" type="text" name="cep" value="{{ old('cep', $professor->cep) }}" maxlength="10" placeholder="00000-000">
                        @error('cep')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-8 form-group">
                        <label for="cidade">Cidade</label>
                        <input id="cidade" class="form-control @error('cidade') is-invalid @enderror" type="text" name="cidade" value="{{ old('cidade', $professor->cidade) }}">
                        @error('cidade')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="estado">Estado</label>
                        <input id="estado" class="form-control @error('estado') is-invalid @enderror" type="text" name="estado" value="{{ old('estado', $professor->estado) }}" maxlength="2" placeholder="SP">
                        @error('estado')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>

                <h5 class="mb-3 mt-3">Dados Profissionais</h5>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="especialidade">Especialidade</label>
                        <input id="especialidade" class="form-control @error('especialidade') is-invalid @enderror" type="text" name="especialidade" value="{{ old('especialidade', $professor->especialidade) }}">
                        @error('especialidade')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="formacao">Formação</label>
                        <input id="formacao" class="form-control @error('formacao') is-invalid @enderror" type="text" name="formacao" value="{{ old('formacao', $professor->formacao) }}">
                        @error('formacao')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="registro_profissional">Registro Profissional</label>
                        <input id="registro_profissional" class="form-control @error('registro_profissional') is-invalid @enderror" type="text" name="registro_profissional" value="{{ old('registro_profissional', $professor->registro_profissional) }}">
                        @error('registro_profissional')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="data_admissao">Data de Admissão</label>
                        <input id="data_admissao" class="form-control @error('data_admissao') is-invalid @enderror" type="date" name="data_admissao" value="{{ old('data_admissao', $professor->data_admissao?->format('Y-m-d')) }}">
                        @error('data_admissao')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
                            <option value="ativo" {{ old('status', $professor->status) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                            <option value="inativo" {{ old('status', $professor->status) == 'inativo' ? 'selected' : '' }}>Inativo</option>
                            <option value="afastado" {{ old('status', $professor->status) == 'afastado' ? 'selected' : '' }}>Afastado</option>
                            <option value="aposentado" {{ old('status', $professor->status) == 'aposentado' ? 'selected' : '' }}>Aposentado</option>
                        </select>
                        @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="observacoes">Observações</label>
                        <textarea id="observacoes" class="form-control @error('observacoes') is-invalid @enderror" name="observacoes" rows="3">{{ old('observacoes', $professor->observacoes) }}</textarea>
                        @error('observacoes')<span class="invalid-feedback">{{ $message }}</span>@enderror
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
