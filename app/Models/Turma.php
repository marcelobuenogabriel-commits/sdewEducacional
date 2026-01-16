<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Turma extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'codigo',
        'descricao',
        'ano',
        'periodo',
        'vagas_total',
        'vagas_ocupadas',
        'ativo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ativo' => 'boolean',
        'ano' => 'integer',
        'vagas_total' => 'integer',
        'vagas_ocupadas' => 'integer',
    ];

    /**
     * Get the alunos for the turma.
     */
    public function alunos(): HasMany
    {
        return $this->hasMany(Aluno::class);
    }
}
