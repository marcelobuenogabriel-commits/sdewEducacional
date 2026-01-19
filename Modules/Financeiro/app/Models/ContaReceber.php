<?php

namespace Modules\Financeiro\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class ContaReceber extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'contas_receber';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'descricao',
        'numero_documento',
        'valor_original',
        'valor_recebido',
        'valor_desconto',
        'valor_juros',
        'valor_multa',
        'data_emissao',
        'data_vencimento',
        'data_recebimento',
        'aluno_id',
        'pagador',
        'cnpj_cpf_pagador',
        'categoria',
        'status',
        'forma_recebimento',
        'observacoes',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'valor_original' => 'decimal:2',
        'valor_recebido' => 'decimal:2',
        'valor_desconto' => 'decimal:2',
        'valor_juros' => 'decimal:2',
        'valor_multa' => 'decimal:2',
        'data_emissao' => 'date',
        'data_vencimento' => 'date',
        'data_recebimento' => 'date',
    ];

    /**
     * Get the user who registered the account.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the aluno associated with this receivable.
     */
    public function aluno(): BelongsTo
    {
        return $this->belongsTo(\Modules\Aluno\Models\Aluno::class);
    }

    /**
     * Calculate the total amount to receive.
     */
    public function getValorTotalAttribute(): float
    {
        return $this->valor_original + $this->valor_juros + $this->valor_multa - $this->valor_desconto;
    }

    /**
     * Check if the account is overdue.
     */
    public function isAtrasada(): bool
    {
        return $this->status === 'pendente' && $this->data_vencimento < now();
    }
}
