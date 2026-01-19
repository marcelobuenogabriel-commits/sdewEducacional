<?php

namespace Modules\Disciplina\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Disciplina extends Model
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
        'carga_horaria',
        'creditos',
        'ementa',
        'ativo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ativo' => 'boolean',
        'carga_horaria' => 'integer',
        'creditos' => 'integer',
    ];

    /**
     * Get the professores that teach this disciplina.
     */
    public function professores(): BelongsToMany
    {
        return $this->belongsToMany(
            \Modules\Professor\Models\Professor::class,
            'disciplina_professor',
            'disciplina_id',
            'professor_id'
        )->withTimestamps();
    }

    /**
     * Get the turmas where this disciplina is taught.
     */
    public function turmas(): BelongsToMany
    {
        return $this->belongsToMany(
            \Modules\Turma\Models\Turma::class,
            'disciplina_turma',
            'disciplina_id',
            'turma_id'
        )->withTimestamps();
    }
}
