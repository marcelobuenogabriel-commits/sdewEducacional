<?php

namespace Modules\Aluno\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Turma\Models\Turma;

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
        'empresa_id',
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
     * Get the empresa that owns the aluno.
     */
    public function empresa(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Empresa::class);
    }

    /**
     * Get the matriculas for the aluno.
     */
    public function matriculas(): HasMany
    {
        return $this->hasMany(\Modules\Matricula\Models\Matricula::class);
    }

    /**
     * Get the turmas through matriculas.
     */
    public function turmas()
    {
        return $this->hasManyThrough(
            Turma::class,
            \Modules\Matricula\Models\Matricula::class,
            'aluno_id',
            'id',
            'id',
            'turma_id'
        );
    }

    /**
     * Get the avaliacoes for the aluno.
     */
    public function avaliacoes(): HasMany
    {
        return $this->hasMany(\Modules\Avaliacao\Models\Avaliacao::class);
    }
}
