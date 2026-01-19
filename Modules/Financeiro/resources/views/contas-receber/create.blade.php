@extends('adminlte::page')

@section('title', 'Nova Conta a Receber')

@section('content_header')
    <h1><i class="fas fa-money-bill-wave"></i> Nova Conta a Receber</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('financeiro.contas-receber.store') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="descricao">Descrição <span class="text-danger">*</span></label>
                        <input id="descricao" class="form-control @error('descricao') is-invalid @enderror" type="text" name="descricao" value="{{ old('descricao') }}" required>
                        @error('descricao')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="cliente">Cliente/Aluno <span class="text-danger">*</span></label>
                        <input id="cliente" class="form-control @error('cliente') is-invalid @enderror" type="text" name="cliente" value="{{ old('cliente') }}" required>
                        @error('cliente')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="valor">Valor <span class="text-danger">*</span></label>
                        <input id="valor" class="form-control @error('valor') is-invalid @enderror" type="number" step="0.01" name="valor" value="{{ old('valor') }}" required>
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
                            <option value="mensalidade">Mensalidade</option>
                            <option value="matricula">Matrícula</option>
                            <option value="material">Material</option>
                            <option value="outros">Outros</option>
                        </select>
                        @error('categoria')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('financeiro.contas-receber.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Cadastrar</button>
            </div>
        </form>
    </div>
@stop
