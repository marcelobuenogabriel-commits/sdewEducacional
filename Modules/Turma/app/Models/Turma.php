<?php

namespace Modules\Turma\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Aluno\Models\Aluno;
use Modules\Professor\Models\Professor;
use Modules\Disciplina\Models\Disciplina;

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

    /**
     * Get the professores that teach in this turma.
     */
    public function professores(): BelongsToMany
    {
        return $this->belongsToMany(
            Professor::class,
            'professor_turma',
            'turma_id',
            'professor_id'
        )->withTimestamps();
    }

    /**
     * Get the disciplinas taught in this turma.
     */
    public function disciplinas(): BelongsToMany
    {
        return $this->belongsToMany(
            Disciplina::class,
            'disciplina_turma',
            'turma_id',
            'disciplina_id'
        )->withTimestamps();
    }
}
