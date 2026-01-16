<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Turma') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('turmas.update', $turma) }}">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nome -->
                            <div class="col-span-2">
                                <x-input-label for="nome" :value="__('Nome da Turma')" />
                                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome', $turma->nome)" required autofocus placeholder="Ex: 3º Ano A" />
                                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                            </div>

                            <!-- Código -->
                            <div>
                                <x-input-label for="codigo" :value="__('Código')" />
                                <x-text-input id="codigo" class="block mt-1 w-full" type="text" name="codigo" :value="old('codigo', $turma->codigo)" required placeholder="Ex: 3A-2026" />
                                <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
                                <p class="mt-1 text-sm text-gray-500">Código único para identificação da turma</p>
                            </div>

                            <!-- Ano -->
                            <div>
                                <x-input-label for="ano" :value="__('Ano Letivo')" />
                                <x-text-input id="ano" class="block mt-1 w-full" type="number" name="ano" :value="old('ano', $turma->ano)" required min="2000" max="2100" />
                                <x-input-error :messages="$errors->get('ano')" class="mt-2" />
                            </div>

                            <!-- Período -->
                            <div>
                                <x-input-label for="periodo" :value="__('Período')" />
                                <select id="periodo" name="periodo" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Selecione o período</option>
                                    <option value="matutino" {{ old('periodo', $turma->periodo) == 'matutino' ? 'selected' : '' }}>Matutino</option>
                                    <option value="vespertino" {{ old('periodo', $turma->periodo) == 'vespertino' ? 'selected' : '' }}>Vespertino</option>
                                    <option value="noturno" {{ old('periodo', $turma->periodo) == 'noturno' ? 'selected' : '' }}>Noturno</option>
                                    <option value="integral" {{ old('periodo', $turma->periodo) == 'integral' ? 'selected' : '' }}>Integral</option>
                                </select>
                                <x-input-error :messages="$errors->get('periodo')" class="mt-2" />
                            </div>

                            <!-- Vagas Total -->
                            <div>
                                <x-input-label for="vagas_total" :value="__('Total de Vagas')" />
                                <x-text-input id="vagas_total" class="block mt-1 w-full" type="number" name="vagas_total" :value="old('vagas_total', $turma->vagas_total)" required min="1" />
                                <x-input-error :messages="$errors->get('vagas_total')" class="mt-2" />
                            </div>

                            <!-- Status Ativo -->
                            <div class="flex items-center">
                                <input id="ativo" name="ativo" type="checkbox" value="1" {{ old('ativo', $turma->ativo) ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="ativo" class="ml-2 block text-sm text-gray-900">
                                    Turma Ativa
                                </label>
                            </div>

                            <!-- Descrição -->
                            <div class="col-span-2">
                                <x-input-label for="descricao" :value="__('Descrição')" />
                                <textarea id="descricao" name="descricao" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Informações adicionais sobre a turma">{{ old('descricao', $turma->descricao) }}</textarea>
                                <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('turmas.index') }}" class="text-gray-600 hover:text-gray-900">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Atualizar Turma') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
