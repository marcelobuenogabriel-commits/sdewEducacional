@extends('adminlte::page')

@section('title', 'Editar Conta a Pagar')

@section('content_header')
    <h1><i class="fas fa-file-invoice-dollar"></i> Editar Conta a Pagar</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('financeiro.contas-pagar.update', $contaPagar) }}">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="descricao">Descrição <span class="text-danger">*</span></label>
                        <input id="descricao" class="form-control @error('descricao') is-invalid @enderror" type="text" name="descricao" value="{{ old('descricao', $contaPagar->descricao) }}" required>
                        @error('descricao')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="fornecedor">Fornecedor <span class="text-danger">*</span></label>
                        <input id="fornecedor" class="form-control @error('fornecedor') is-invalid @enderror" type="text" name="fornecedor" value="{{ old('fornecedor', $contaPagar->fornecedor) }}" required>
                        @error('fornecedor')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="valor">Valor <span class="text-danger">*</span></label>
                        <input id="valor" class="form-control @error('valor') is-invalid @enderror" type="number" step="0.01" name="valor" value="{{ old('valor', $contaPagar->valor) }}" required>
                        @error('valor')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="data_vencimento">Data de Vencimento <span class="text-danger">*</span></label>
                        <input id="data_vencimento" class="form-control @error('data_vencimento') is-invalid @enderror" type="date" name="data_vencimento" value="{{ old('data_vencimento', $contaPagar->data_vencimento?->format('Y-m-d')) }}" required>
                        @error('data_vencimento')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="custom-control custom-checkbox mt-4">
                            <input type="checkbox" class="custom-control-input" id="pago" name="pago" value="1" {{ old('pago', $contaPagar->pago) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="pago">Pago</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('financeiro.contas-pagar.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Atualizar</button>
            </div>
        </form>
    </div>
@stop
