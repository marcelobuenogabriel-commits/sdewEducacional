<?php

namespace Modules\Relatorio\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Relatorio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nome',
        'tipo',
        'descricao',
        'parametros',
        'filtros',
        'formato',
        'user_id',
        'data_geracao',
        'caminho_arquivo',
        'status',
        'erro_mensagem',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'parametros' => 'array',
        'filtros' => 'array',
        'data_geracao' => 'datetime',
    ];

    /**
     * Get the user who generated the report.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
