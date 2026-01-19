@extends('adminlte::page')

@section('title', 'Nova Comunicação')

@section('content_header')
    <h1><i class="fas fa-envelope"></i> Nova Comunicação</h1>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('comunicacoes.store') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="titulo">Título <span class="text-danger">*</span></label>
                        <input id="titulo" class="form-control @error('titulo') is-invalid @enderror" type="text" name="titulo" value="{{ old('titulo') }}" required>
                        @error('titulo')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="tipo">Tipo <span class="text-danger">*</span></label>
                        <select id="tipo" name="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
                            <option value="email">Email</option>
                            <option value="sms">SMS</option>
                            <option value="notificacao">Notificação</option>
                        </select>
                        @error('tipo')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="destinatario">Destinatário <span class="text-danger">*</span></label>
                        <input id="destinatario" class="form-control @error('destinatario') is-invalid @enderror" type="text" name="destinatario" value="{{ old('destinatario') }}" required>
                        @error('destinatario')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="mensagem">Mensagem <span class="text-danger">*</span></label>
                        <textarea id="mensagem" name="mensagem" rows="5" class="form-control @error('mensagem') is-invalid @enderror" required>{{ old('mensagem') }}</textarea>
                        @error('mensagem')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('comunicacoes.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-paper-plane"></i> Enviar</button>
            </div>
        </form>
    </div>
@stop
