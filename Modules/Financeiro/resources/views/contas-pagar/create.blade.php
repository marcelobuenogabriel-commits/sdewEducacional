@extends('adminlte::page')

@section('title', 'Nova Conta a Pagar')

@section('content_header')
    <h1><i class="fas fa-file-invoice-dollar"></i> Nova Conta a Pagar</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('financeiro.contas-pagar.store') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="descricao">Descrição <span class="text-danger">*</span></label>
                        <input id="descricao" class="form-control @error('descricao') is-invalid @enderror" type="text" name="descricao" value="{{ old('descricao') }}" required>
                        @error('descricao')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="fornecedor">Fornecedor <span class="text-danger">*</span></label>
                        <input id="fornecedor" class="form-control @error('fornecedor') is-invalid @enderror" type="text" name="fornecedor" value="{{ old('fornecedor') }}" required>
                        @error('fornecedor')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="valor">Valor <span class="text-danger">*</span></label>
                        <input id="valor" class="form-control @error('valor') is-invalid @enderror" type="text" name="valor" value="{{ old('valor') }}" required data-mask="currency" placeholder="R$ 0,00">
                        @error('valor')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="data_vencimento">Data de Vencimento <span class="text-danger">*</span></label>
                        <input id="data_vencimento" class="form-control @error('data_vencimento') is-invalid @enderror" type="date" name="data_vencimento" value="{{ old('data_vencimento') }}" required>
                        @error('data_vencimento')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="categoria">Categoria</label>
                        <select id="categoria" name="categoria" class="form-control @error('categoria') is-invalid @enderror">
                            <option value="">Selecione</option>
                            <option value="salario">Salário</option>
                            <option value="aluguel">Aluguel</option>
                            <option value="fornecedor">Fornecedor</option>
                            <option value="outros">Outros</option>
                        </select>
                        @error('categoria')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('financeiro.contas-pagar.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Cadastrar</button>
            </div>
        </form>
    </div>
@stop
