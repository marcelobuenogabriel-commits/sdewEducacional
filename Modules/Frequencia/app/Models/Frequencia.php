<?php

namespace Modules\Frequencia\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Frequencia extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'aluno_id',
        'disciplina_id',
        'turma_id',
        'professor_id',
        'data',
        'presenca',
        'justificativa',
        'observacoes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'date',
        'presenca' => 'boolean',
    ];

    /**
     * Get the aluno that owns the frequencia.
     */
    public function aluno(): BelongsTo
    {
        return $this->belongsTo(\Modules\Aluno\Models\Aluno::class);
    }

    /**
     * Get the disciplina that owns the frequencia.
     */
    public function disciplina(): BelongsTo
    {
        return $this->belongsTo(\Modules\Disciplina\Models\Disciplina::class);
    }

    /**
     * Get the turma that owns the frequencia.
     */
    public function turma(): BelongsTo
    {
        return $this->belongsTo(\Modules\Turma\Models\Turma::class);
    }

    /**
     * Get the professor that registered the frequencia.
     */
    public function professor(): BelongsTo
    {
        return $this->belongsTo(\Modules\Professor\Models\Professor::class);
    }
}
