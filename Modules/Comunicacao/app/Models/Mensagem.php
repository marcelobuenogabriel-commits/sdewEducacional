<?php

namespace Modules\Comunicacao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Mensagem extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'mensagens';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'assunto',
        'conteudo',
        'tipo',
        'prioridade',
        'remetente_id',
        'destinatario_id',
        'turma_id',
        'data_envio',
        'data_leitura',
        'lida',
        'arquivada',
        'mensagem_pai_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'data_envio' => 'datetime',
        'data_leitura' => 'datetime',
        'lida' => 'boolean',
        'arquivada' => 'boolean',
    ];

    /**
     * Get the sender of the message.
     */
    public function remetente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'remetente_id');
    }

    /**
     * Get the recipient of the message.
     */
    public function destinatario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'destinatario_id');
    }

    /**
     * Get the turma associated with the message.
     */
    public function turma(): BelongsTo
    {
        return $this->belongsTo(\Modules\Turma\Models\Turma::class);
    }

    /**
     * Get the parent message if this is a reply.
     */
    public function mensagemPai(): BelongsTo
    {
        return $this->belongsTo(Mensagem::class, 'mensagem_pai_id');
    }

    /**
     * Get the replies to this message.
     */
    public function respostas(): HasMany
    {
        return $this->hasMany(Mensagem::class, 'mensagem_pai_id');
    }
}
