@extends('adminlte::page')

@section('title', 'Editar Conciliação Bancária')

@section('content_header')
    <h1><i class="fas fa-university"></i> Editar Conciliação Bancária</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('financeiro.conciliacoes-bancarias.update', $conciliacaoBancaria) }}">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="data">Data <span class="text-danger">*</span></label>
                        <input id="data" class="form-control @error('data') is-invalid @enderror" type="date" name="data" value="{{ old('data', $conciliacaoBancaria->data?->format('Y-m-d')) }}" required>
                        @error('data')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="banco">Banco <span class="text-danger">*</span></label>
                        <input id="banco" class="form-control @error('banco') is-invalid @enderror" type="text" name="banco" value="{{ old('banco', $conciliacaoBancaria->banco) }}" required>
                        @error('banco')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="saldo_inicial">Saldo Inicial <span class="text-danger">*</span></label>
                        <input id="saldo_inicial" class="form-control @error('saldo_inicial') is-invalid @enderror" type="number" step="0.01" name="saldo_inicial" value="{{ old('saldo_inicial', $conciliacaoBancaria->saldo_inicial) }}" required>
                        @error('saldo_inicial')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="saldo_final">Saldo Final <span class="text-danger">*</span></label>
                        <input id="saldo_final" class="form-control @error('saldo_final') is-invalid @enderror" type="number" step="0.01" name="saldo_final" value="{{ old('saldo_final', $conciliacaoBancaria->saldo_final) }}" required>
                        @error('saldo_final')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="custom-control custom-checkbox mt-4">
                            <input type="checkbox" class="custom-control-input" id="conciliado" name="conciliado" value="1" {{ old('conciliado', $conciliacaoBancaria->conciliado) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="conciliado">Conciliado</label>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="observacoes">Observações</label>
                        <textarea id="observacoes" name="observacoes" rows="3" class="form-control @error('observacoes') is-invalid @enderror">{{ old('observacoes', $conciliacaoBancaria->observacoes) }}</textarea>
                        @error('observacoes')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('financeiro.conciliacoes-bancarias.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Atualizar</button>
            </div>
        </form>
    </div>
@stop
