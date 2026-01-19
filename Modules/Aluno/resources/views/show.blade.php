@extends('adminlte::page')

@section('title', 'Detalhes do Aluno')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-user-graduate"></i> Detalhes do Aluno</h1>
        <div>
            <a href="{{ route('alunos.edit', $aluno) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('alunos.index') }}" class="btn btn-default">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-info-circle"></i> Informações Pessoais</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-user"></i> Nome Completo</strong>
                    <p class="text-muted">{{ $aluno->nome }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-id-card"></i> Matrícula</strong>
                    <p class="text-muted">{{ $aluno->matricula }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-id-card"></i> CPF</strong>
                    <p class="text-muted">{{ $aluno->cpf }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-id-card"></i> RG</strong>
                    <p class="text-muted">{{ $aluno->rg ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-birthday-cake"></i> Data de Nascimento</strong>
                    <p class="text-muted">{{ $aluno->data_nascimento?->format('d/m/Y') ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-flag"></i> Status</strong>
                    <p>
                        @if($aluno->status === 'ativo')
                            <span class="badge badge-success">Ativo</span>
                        @elseif($aluno->status === 'trancado')
                            <span class="badge badge-warning">Trancado</span>
                        @elseif($aluno->status === 'concluido')
                            <span class="badge badge-info">Concluído</span>
                        @else
                            <span class="badge badge-danger">Inativo</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-envelope"></i> Informações de Contato</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-envelope"></i> Email</strong>
                    <p class="text-muted">{{ $aluno->email }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-phone"></i> Telefone</strong>
                    <p class="text-muted">{{ $aluno->telefone ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-mobile-alt"></i> Celular</strong>
                    <p class="text-muted">{{ $aluno->celular ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-map-marker-alt"></i> Endereço</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <strong><i class="fas fa-road"></i> Endereço</strong>
                    <p class="text-muted">{{ $aluno->endereco ?? '-' }}</p>
                </div>
                <div class="col-md-2">
                    <strong>Número</strong>
                    <p class="text-muted">{{ $aluno->numero ?? '-' }}</p>
                </div>
                <div class="col-md-2">
                    <strong>Complemento</strong>
                    <p class="text-muted">{{ $aluno->complemento ?? '-' }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Bairro</strong>
                    <p class="text-muted">{{ $aluno->bairro ?? '-' }}</p>
                </div>
                <div class="col-md-4">
                    <strong><i class="fas fa-city"></i> Cidade</strong>
                    <p class="text-muted">{{ $aluno->cidade ?? '-' }}</p>
                </div>
                <div class="col-md-2">
                    <strong>Estado</strong>
                    <p class="text-muted">{{ $aluno->estado ?? '-' }}</p>
                </div>
                <div class="col-md-2">
                    <strong>CEP</strong>
                    <p class="text-muted">{{ $aluno->cep ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-graduation-cap"></i> Informações Acadêmicas</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-users"></i> Turma</strong>
                    <p class="text-muted">
                        @if($aluno->turma)
                            <a href="{{ route('turmas.show', $aluno->turma) }}" class="text-primary">
                                {{ $aluno->turma->nome }} ({{ $aluno->turma->codigo }})
                            </a>
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if($aluno->observacoes)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-sticky-note"></i> Observações</h3>
            </div>
            <div class="card-body">
                <p style="white-space: pre-line;">{{ $aluno->observacoes }}</p>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-clock"></i> Informações do Sistema</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Cadastrado em</strong>
                    <p class="text-muted">{{ $aluno->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Última atualização</strong>
                    <p class="text-muted">{{ $aluno->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
@stop
