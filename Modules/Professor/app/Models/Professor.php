<?php

namespace Modules\Professor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Professor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'professores';
    
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
        'especialidade',
        'formacao',
        'registro_profissional',
        'data_admissao',
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
        'data_admissao' => 'date',
    ];

    /**
     * Get the turmas that the professor teaches.
     */
    public function turmas(): BelongsToMany
    {
        return $this->belongsToMany(
            \Modules\Turma\Models\Turma::class,
            'professor_turma',
            'professor_id',
            'turma_id'
        )->withTimestamps();
    }

    /**
     * Get the disciplinas that the professor teaches.
     */
    public function disciplinas(): BelongsToMany
    {
        return $this->belongsToMany(
            \Modules\Disciplina\Models\Disciplina::class,
            'disciplina_professor',
            'professor_id',
            'disciplina_id'
        )->withTimestamps();
    }
}
