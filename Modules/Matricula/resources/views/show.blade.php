<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhes da Matrícula') }}
            </h2>
            <a href="{{ route('matriculas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Informações Gerais</h3>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">ID:</label>
                                <p class="text-gray-900">#{{ $matricula->id }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">Aluno:</label>
                                <p class="text-gray-900">{{ $matricula->aluno?->nome ?? '-' }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">CPF do Aluno:</label>
                                <p class="text-gray-900">{{ $matricula->aluno?->cpf ?? '-' }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">Turma:</label>
                                <p class="text-gray-900">{{ $matricula->turma?->nome ?? '-' }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">Código da Turma:</label>
                                <p class="text-gray-900">{{ $matricula->turma?->codigo ?? '-' }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">Status:</label>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($matricula->status === 'ativo') bg-green-100 text-green-800
                                    @elseif($matricula->status === 'cancelado') bg-red-100 text-red-800
                                    @elseif($matricula->status === 'transferido') bg-yellow-100 text-yellow-800
                                    @elseif($matricula->status === 'concluido') bg-blue-100 text-blue-800
                                    @endif">
                                    {{ ucfirst($matricula->status) }}
                                </span>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Informações Financeiras</h3>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">Data da Matrícula:</label>
                                <p class="text-gray-900">{{ $matricula->data_matricula->format('d/m/Y') }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">Valor da Mensalidade:</label>
                                <p class="text-gray-900">R$ {{ number_format($matricula->valor_mensalidade, 2, ',', '.') }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">Número de Parcelas:</label>
                                <p class="text-gray-900">{{ $matricula->numero_parcelas }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">Valor Total:</label>
                                <p class="text-gray-900 font-bold">R$ {{ number_format($matricula->valor_mensalidade * $matricula->numero_parcelas, 2, ',', '.') }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">Data de Início:</label>
                                <p class="text-gray-900">{{ $matricula->data_inicio->format('d/m/Y') }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">Data de Fim:</label>
                                <p class="text-gray-900">{{ $matricula->data_fim->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($matricula->observacoes)
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Observações</h3>
                            <p class="text-gray-900 whitespace-pre-line">{{ $matricula->observacoes }}</p>
                        </div>
                    @endif

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('matriculas.edit', $matricula) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Editar
                        </a>
                        <form action="{{ route('matriculas.destroy', $matricula) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir esta matrícula?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
