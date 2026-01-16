<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhes da Turma') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('turmas.edit', $turma) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Editar
                </a>
                <a href="{{ route('turmas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Voltar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Informações da Turma -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Informações da Turma</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nome</p>
                            <p class="mt-1 text-gray-900">{{ $turma->nome }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Código</p>
                            <p class="mt-1 text-gray-900">{{ $turma->codigo }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Ano Letivo</p>
                            <p class="mt-1 text-gray-900">{{ $turma->ano }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Período</p>
                            <p class="mt-1 text-gray-900">{{ ucfirst($turma->periodo) }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Vagas</p>
                            <p class="mt-1 text-gray-900">
                                {{ $turma->vagas_ocupadas }} / {{ $turma->vagas_total }}
                                @if($turma->vagas_ocupadas >= $turma->vagas_total)
                                    <span class="text-red-600 font-semibold">(Lotada)</span>
                                @else
                                    <span class="text-green-600">({{ $turma->vagas_total - $turma->vagas_ocupadas }} vagas disponíveis)</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Status</p>
                            <p class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($turma->ativo) bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $turma->ativo ? 'Ativa' : 'Inativa' }}
                                </span>
                            </p>
                        </div>
                        @if($turma->descricao)
                            <div class="col-span-2">
                                <p class="text-sm font-medium text-gray-500">Descrição</p>
                                <p class="mt-1 text-gray-900 whitespace-pre-line">{{ $turma->descricao }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Informações do Sistema -->
                    <div class="mt-8 pt-6 border-t">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Cadastrada em</p>
                                <p class="mt-1 text-gray-900 text-sm">{{ $turma->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Última atualização</p>
                                <p class="mt-1 text-gray-900 text-sm">{{ $turma->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Alunos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">
                        Alunos Matriculados ({{ $turma->alunos->count() }})
                    </h3>
                    
                    @if($turma->alunos->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Matrícula
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nome
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($turma->alunos as $aluno)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $aluno->matricula }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $aluno->nome }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $aluno->email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($aluno->status === 'ativo') bg-green-100 text-green-800
                                                    @elseif($aluno->status === 'trancado') bg-yellow-100 text-yellow-800
                                                    @elseif($aluno->status === 'concluido') bg-blue-100 text-blue-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst($aluno->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('alunos.show', $aluno) }}" class="text-blue-600 hover:text-blue-900">Ver Detalhes</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">Nenhum aluno matriculado nesta turma.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
