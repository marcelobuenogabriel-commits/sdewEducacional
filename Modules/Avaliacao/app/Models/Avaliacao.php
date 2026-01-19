<?php

namespace Modules\Avaliacao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avaliacao extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'avaliacoes';
    
    protected $fillable = [
        'aluno_id',
        'disciplina_id',
        'turma_id',
        'professor_id',
        'tipo_avaliacao',
        'descricao',
        'data_avaliacao',
        'nota',
        'peso',
        'observacoes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_avaliacao' => 'date',
        'nota' => 'decimal:2',
        'peso' => 'decimal:2',
    ];

    /**
     * Get the aluno that owns the avaliacao.
     */
    public function aluno(): BelongsTo
    {
        return $this->belongsTo(\Modules\Aluno\Models\Aluno::class);
    }

    /**
     * Get the disciplina that owns the avaliacao.
     */
    public function disciplina(): BelongsTo
    {
        return $this->belongsTo(\Modules\Disciplina\Models\Disciplina::class);
    }

    /**
     * Get the turma that owns the avaliacao.
     */
    public function turma(): BelongsTo
    {
        return $this->belongsTo(\Modules\Turma\Models\Turma::class);
    }

    /**
     * Get the professor that owns the avaliacao.
     */
    public function professor(): BelongsTo
    {
        return $this->belongsTo(\Modules\Professor\Models\Professor::class);
    }
}
