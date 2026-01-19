<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova Matrícula') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Erro!</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('matriculas.matricular') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="aluno_id" class="block text-sm font-medium text-gray-700">Aluno *</label>
                                <select id="aluno_id" name="aluno_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Selecione um aluno</option>
                                    @foreach($alunos as $aluno)
                                        <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>
                                            {{ $aluno->nome }} - {{ $aluno->cpf }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="turma_id" class="block text-sm font-medium text-gray-700">Turma *</label>
                                <select id="turma_id" name="turma_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Selecione uma turma</option>
                                    @foreach($turmas as $turma)
                                        <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>
                                            {{ $turma->nome }} - Vagas: {{ $turma->vagas_total - $turma->vagas_ocupadas }}/{{ $turma->vagas_total }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="data_matricula" class="block text-sm font-medium text-gray-700">Data da Matrícula *</label>
                                <input type="date" id="data_matricula" name="data_matricula" value="{{ old('data_matricula', date('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="valor_mensalidade" class="block text-sm font-medium text-gray-700">Valor da Mensalidade (R$) *</label>
                                <input type="number" step="0.01" id="valor_mensalidade" name="valor_mensalidade" value="{{ old('valor_mensalidade') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="numero_parcelas" class="block text-sm font-medium text-gray-700">Número de Parcelas *</label>
                                <input type="number" id="numero_parcelas" name="numero_parcelas" value="{{ old('numero_parcelas', 12) }}" min="1" max="24" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="data_inicio" class="block text-sm font-medium text-gray-700">Data de Início *</label>
                                <input type="date" id="data_inicio" name="data_inicio" value="{{ old('data_inicio') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="data_fim" class="block text-sm font-medium text-gray-700">Data de Fim *</label>
                                <input type="date" id="data_fim" name="data_fim" value="{{ old('data_fim') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
                            <textarea id="observacoes" name="observacoes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('observacoes') }}</textarea>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('matriculas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Realizar Matrícula
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
