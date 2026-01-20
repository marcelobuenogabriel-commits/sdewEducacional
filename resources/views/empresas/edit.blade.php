@extends('adminlte::page')

@section('title', 'Editar Empresa')

@section('content_header')
    <h1><i class="fas fa-building"></i> Editar Empresa</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('empresas.index') }}">Empresas</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar Informações da Empresa</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('empresas.update', $empresa) }}" id="edit-form">
                @csrf
                @method('PATCH')

                <div class="row">
                    <!-- Nome Fantasia -->
                    <div class="col-md-6 form-group">
                        <label for="nome">Nome Fantasia <span class="text-danger">*</span></label>
                        <input id="nome" class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" value="{{ old('nome', $empresa->nome) }}" required autofocus>
                        @error('nome')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Razão Social -->
                    <div class="col-md-6 form-group">
                        <label for="razao_social">Razão Social <span class="text-danger">*</span></label>
                        <input id="razao_social" class="form-control @error('razao_social') is-invalid @enderror" type="text" name="razao_social" value="{{ old('razao_social', $empresa->razao_social) }}" required>
                        @error('razao_social')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- CNPJ -->
                    <div class="col-md-6 form-group">
                        <label for="cnpj">CNPJ <span class="text-danger">*</span></label>
                        <input id="cnpj" class="form-control @error('cnpj') is-invalid @enderror" type="text" name="cnpj" value="{{ old('cnpj', $empresa->cnpj) }}" required placeholder="00.000.000/0000-00">
                        @error('cnpj')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Responsável -->
                    <div class="col-md-6 form-group">
                        <label for="responsavel">Responsável</label>
                        <input id="responsavel" class="form-control @error('responsavel') is-invalid @enderror" type="text" name="responsavel" value="{{ old('responsavel', $empresa->responsavel) }}">
                        @error('responsavel')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 form-group">
                        <label for="email">Email</label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', $empresa->email) }}">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Telefone -->
                    <div class="col-md-6 form-group">
                        <label for="telefone">Telefone</label>
                        <input id="telefone" class="form-control @error('telefone') is-invalid @enderror" type="text" name="telefone" value="{{ old('telefone', $empresa->telefone) }}" placeholder="(00) 0000-0000">
                        @error('telefone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Celular -->
                    <div class="col-md-6 form-group">
                        <label for="celular">Celular</label>
                        <input id="celular" class="form-control @error('celular') is-invalid @enderror" type="text" name="celular" value="{{ old('celular', $empresa->celular) }}" placeholder="(00) 00000-0000">
                        @error('celular')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="ativa" {{ old('status', $empresa->status) == 'ativa' ? 'selected' : '' }}>Ativa</option>
                            <option value="inativa" {{ old('status', $empresa->status) == 'inativa' ? 'selected' : '' }}>Inativa</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- CEP -->
                    <div class="col-md-4 form-group">
                        <label for="cep">CEP</label>
                        <input id="cep" class="form-control @error('cep') is-invalid @enderror" type="text" name="cep" value="{{ old('cep', $empresa->cep) }}" placeholder="00000-000">
                        @error('cep')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Endereço -->
                    <div class="col-md-12 form-group">
                        <label for="endereco">Endereço (Rua/Logradouro)</label>
                        <input id="endereco" class="form-control @error('endereco') is-invalid @enderror" type="text" name="endereco" value="{{ old('endereco', $empresa->endereco) }}">
                        @error('endereco')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Número -->
                    <div class="col-md-4 form-group">
                        <label for="numero">Número</label>
                        <input id="numero" class="form-control @error('numero') is-invalid @enderror" type="text" name="numero" value="{{ old('numero', $empresa->numero) }}">
                        @error('numero')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Complemento -->
                    <div class="col-md-4 form-group">
                        <label for="complemento">Complemento</label>
                        <input id="complemento" class="form-control @error('complemento') is-invalid @enderror" type="text" name="complemento" value="{{ old('complemento', $empresa->complemento) }}">
                        @error('complemento')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Bairro -->
                    <div class="col-md-4 form-group">
                        <label for="bairro">Bairro</label>
                        <input id="bairro" class="form-control @error('bairro') is-invalid @enderror" type="text" name="bairro" value="{{ old('bairro', $empresa->bairro) }}">
                        @error('bairro')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Cidade -->
                    <div class="col-md-8 form-group">
                        <label for="cidade">Cidade</label>
                        <input id="cidade" class="form-control @error('cidade') is-invalid @enderror" type="text" name="cidade" value="{{ old('cidade', $empresa->cidade) }}">
                        @error('cidade')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div class="col-md-4 form-group">
                        <label for="estado">Estado (UF)</label>
                        <input id="estado" class="form-control @error('estado') is-invalid @enderror" type="text" name="estado" value="{{ old('estado', $empresa->estado) }}" maxlength="2" placeholder="SP">
                        @error('estado')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Observações -->
                    <div class="col-md-12 form-group">
                        <label for="observacoes">Observações</label>
                        <textarea id="observacoes" name="observacoes" rows="3" class="form-control @error('observacoes') is-invalid @enderror">{{ old('observacoes', $empresa->observacoes) }}</textarea>
                        @error('observacoes')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <a href="{{ route('empresas.index') }}" class="btn btn-default">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
            <button type="submit" form="edit-form" class="btn btn-primary float-right">
                <i class="fas fa-save"></i> Atualizar Empresa
            </button>
        </div>
    </div>

    <script>
        // CEP Integration with ViaCEP API
        document.getElementById('cep').addEventListener('blur', function() {
            const cep = this.value.replace(/\D/g, '');
            
            if (cep.length === 8) {
                // Show loading state
                this.classList.add('is-loading');
                
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            // Fill the address fields
                            document.getElementById('endereco').value = data.logradouro || '';
                            document.getElementById('bairro').value = data.bairro || '';
                            document.getElementById('cidade').value = data.localidade || '';
                            document.getElementById('estado').value = data.uf || '';
                            
                            // Focus on number field
                            document.getElementById('numero').focus();
                        } else {
                            alert('CEP não encontrado.');
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar CEP:', error);
                        alert('Erro ao buscar o CEP. Por favor, tente novamente.');
                    })
                    .finally(() => {
                        this.classList.remove('is-loading');
                    });
            }
        });
    </script>
@stop
