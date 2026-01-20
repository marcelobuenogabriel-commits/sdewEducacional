<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'razao_social',
        'cnpj',
        'email',
        'telefone',
        'celular',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'responsavel',
        'status',
        'observacoes',
    ];

    /**
     * Get the alunos for the empresa.
     */
    public function alunos(): HasMany
    {
        return $this->hasMany(\Modules\Aluno\Models\Aluno::class);
    }
}
