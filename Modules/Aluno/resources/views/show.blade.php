<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhes do Aluno') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('alunos.edit', $aluno) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Editar
                </a>
                <a href="{{ route('alunos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Voltar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Informações Pessoais -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Informações Pessoais</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nome Completo</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->nome }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Matrícula</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->matricula }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">CPF</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->cpf }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">RG</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->rg ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Data de Nascimento</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->data_nascimento?->format('d/m/Y') ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <p class="mt-1">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($aluno->status === 'ativo') bg-green-100 text-green-800
                                        @elseif($aluno->status === 'trancado') bg-yellow-100 text-yellow-800
                                        @elseif($aluno->status === 'concluido') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($aluno->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Informações de Contato -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Informações de Contato</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Telefone</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->telefone ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Celular</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->celular ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Endereço -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Endereço</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <p class="text-sm font-medium text-gray-500">Endereço</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->endereco ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Número</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->numero ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Complemento</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->complemento ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Bairro</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->bairro ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Cidade</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->cidade ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Estado</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->estado ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">CEP</p>
                                <p class="mt-1 text-gray-900">{{ $aluno->cep ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informações Acadêmicas -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Informações Acadêmicas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Turma</p>
                                <p class="mt-1 text-gray-900">
                                    @if($aluno->turma)
                                        <a href="{{ route('turmas.show', $aluno->turma) }}" class="text-blue-600 hover:text-blue-900">
                                            {{ $aluno->turma->nome }} ({{ $aluno->turma->codigo }})
                                        </a>
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Observações -->
                    @if($aluno->observacoes)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Observações</h3>
                            <p class="text-gray-900 whitespace-pre-line">{{ $aluno->observacoes }}</p>
                        </div>
                    @endif

                    <!-- Informações do Sistema -->
                    <div class="mt-8 pt-6 border-t">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Cadastrado em</p>
                                <p class="mt-1 text-gray-900 text-sm">{{ $aluno->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Última atualização</p>
                                <p class="mt-1 text-gray-900 text-sm">{{ $aluno->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
