<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Aluno') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('alunos.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nome -->
                            <div class="col-span-2">
                                <x-input-label for="nome" :value="__('Nome Completo')" />
                                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus />
                                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                            </div>

                            <!-- CPF -->
                            <div>
                                <x-input-label for="cpf" :value="__('CPF')" />
                                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required placeholder="000.000.000-00" />
                                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                            </div>

                            <!-- RG -->
                            <div>
                                <x-input-label for="rg" :value="__('RG')" />
                                <x-text-input id="rg" class="block mt-1 w-full" type="text" name="rg" :value="old('rg')" />
                                <x-input-error :messages="$errors->get('rg')" class="mt-2" />
                            </div>

                            <!-- Data de Nascimento -->
                            <div>
                                <x-input-label for="data_nascimento" :value="__('Data de Nascimento')" />
                                <x-text-input id="data_nascimento" class="block mt-1 w-full" type="date" name="data_nascimento" :value="old('data_nascimento')" required />
                                <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
                            </div>

                            <!-- Matrícula -->
                            <div>
                                <x-input-label for="matricula" :value="__('Matrícula')" />
                                <x-text-input id="matricula" class="block mt-1 w-full" type="text" name="matricula" :value="old('matricula')" required />
                                <x-input-error :messages="$errors->get('matricula')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Telefone -->
                            <div>
                                <x-input-label for="telefone" :value="__('Telefone')" />
                                <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone" :value="old('telefone')" placeholder="(00) 0000-0000" />
                                <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
                            </div>

                            <!-- Celular -->
                            <div>
                                <x-input-label for="celular" :value="__('Celular')" />
                                <x-text-input id="celular" class="block mt-1 w-full" type="text" name="celular" :value="old('celular')" placeholder="(00) 00000-0000" />
                                <x-input-error :messages="$errors->get('celular')" class="mt-2" />
                            </div>

                            <!-- Turma -->
                            <div>
                                <x-input-label for="turma_id" :value="__('Turma')" />
                                <select id="turma_id" name="turma_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Selecione uma turma</option>
                                    @foreach($turmas as $turma)
                                        <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>
                                            {{ $turma->nome }} - {{ $turma->codigo }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('turma_id')" class="mt-2" />
                            </div>

                            <!-- Endereço -->
                            <div class="col-span-2">
                                <x-input-label for="endereco" :value="__('Endereço')" />
                                <x-text-input id="endereco" class="block mt-1 w-full" type="text" name="endereco" :value="old('endereco')" />
                                <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
                            </div>

                            <!-- Número -->
                            <div>
                                <x-input-label for="numero" :value="__('Número')" />
                                <x-text-input id="numero" class="block mt-1 w-full" type="text" name="numero" :value="old('numero')" />
                                <x-input-error :messages="$errors->get('numero')" class="mt-2" />
                            </div>

                            <!-- Complemento -->
                            <div>
                                <x-input-label for="complemento" :value="__('Complemento')" />
                                <x-text-input id="complemento" class="block mt-1 w-full" type="text" name="complemento" :value="old('complemento')" />
                                <x-input-error :messages="$errors->get('complemento')" class="mt-2" />
                            </div>

                            <!-- Bairro -->
                            <div>
                                <x-input-label for="bairro" :value="__('Bairro')" />
                                <x-text-input id="bairro" class="block mt-1 w-full" type="text" name="bairro" :value="old('bairro')" />
                                <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
                            </div>

                            <!-- Cidade -->
                            <div>
                                <x-input-label for="cidade" :value="__('Cidade')" />
                                <x-text-input id="cidade" class="block mt-1 w-full" type="text" name="cidade" :value="old('cidade')" />
                                <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
                            </div>

                            <!-- Estado -->
                            <div>
                                <x-input-label for="estado" :value="__('Estado (UF)')" />
                                <x-text-input id="estado" class="block mt-1 w-full" type="text" name="estado" :value="old('estado')" maxlength="2" placeholder="SP" />
                                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                            </div>

                            <!-- CEP -->
                            <div>
                                <x-input-label for="cep" :value="__('CEP')" />
                                <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep" :value="old('cep')" placeholder="00000-000" />
                                <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                            </div>

                            <!-- Observações -->
                            <div class="col-span-2">
                                <x-input-label for="observacoes" :value="__('Observações')" />
                                <textarea id="observacoes" name="observacoes" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('observacoes') }}</textarea>
                                <x-input-error :messages="$errors->get('observacoes')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('alunos.index') }}" class="text-gray-600 hover:text-gray-900">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Cadastrar Aluno') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
