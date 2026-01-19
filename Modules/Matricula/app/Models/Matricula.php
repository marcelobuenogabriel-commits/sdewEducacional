<?php

namespace Modules\Matricula\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Aluno\Models\Aluno;
use Modules\Turma\Models\Turma;

class Matricula extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'aluno_id',
        'turma_id',
        'data_matricula',
        'status',
        'valor_mensalidade',
        'numero_parcelas',
        'data_inicio',
        'data_fim',
        'observacoes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_matricula' => 'date',
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'valor_mensalidade' => 'decimal:2',
        'numero_parcelas' => 'integer',
    ];

    /**
     * Get the aluno that owns the matricula.
     */
    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    /**
     * Get the turma that owns the matricula.
     */
    public function turma(): BelongsTo
    {
        return $this->belongsTo(Turma::class);
    }
}
