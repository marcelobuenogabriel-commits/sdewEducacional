<?php

namespace Modules\Financeiro\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class ConciliacaoBancaria extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'conciliacoes_bancarias';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'banco',
        'agencia',
        'conta',
        'data_extrato',
        'arquivo_importado',
        'conteudo_extrato',
        'saldo_inicial',
        'saldo_final',
        'total_creditos',
        'total_debitos',
        'transacoes_conciliadas',
        'transacoes_pendentes',
        'status',
        'observacoes',
        'user_id',
        'data_conciliacao',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'data_extrato' => 'date',
        'saldo_inicial' => 'decimal:2',
        'saldo_final' => 'decimal:2',
        'total_creditos' => 'decimal:2',
        'total_debitos' => 'decimal:2',
        'data_conciliacao' => 'datetime',
    ];

    /**
     * Get the user who performed the reconciliation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate the difference between the calculated and final balances.
     */
    public function getDiferencaSaldoAttribute(): float
    {
        $saldoCalculado = $this->saldo_inicial + $this->total_creditos - $this->total_debitos;
        return $this->saldo_final - $saldoCalculado;
    }

    /**
     * Check if the reconciliation is complete.
     */
    public function isConcluida(): bool
    {
        return $this->status === 'concluida' && $this->transacoes_pendentes === 0;
    }
}
