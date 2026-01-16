<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aluno extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'data_nascimento',
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
        'turma_id',
        'matricula',
        'status',
        'observacoes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_nascimento' => 'date',
    ];

    /**
     * Get the turma that owns the aluno.
     */
    public function turma(): BelongsTo
    {
        return $this->belongsTo(Turma::class);
    }
}
