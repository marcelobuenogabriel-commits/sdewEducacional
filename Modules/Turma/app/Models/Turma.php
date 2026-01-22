<?php

namespace Modules\Turma\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Aluno\Models\Aluno;
use Modules\Professor\Models\Professor;
use Modules\Disciplina\Models\Disciplina;
use Modules\Matricula\Models\Matricula;

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
     * Get the matriculas for the turma.
     */
    public function matriculas(): HasMany
    {
        return $this->hasMany(Matricula::class);
    }

    /**
     * Get the alunos for the turma through matriculas.
     */
    public function alunos(): HasManyThrough
    {
        return $this->hasManyThrough(
            Aluno::class,
            Matricula::class,
            'turma_id',  // Foreign key on matriculas table
            'id',        // Foreign key on alunos table
            'id',        // Local key on turmas table
            'aluno_id'   // Local key on matriculas table
        );
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
