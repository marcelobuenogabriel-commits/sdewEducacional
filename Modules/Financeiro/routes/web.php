<?php

use Illuminate\Support\Facades\Route;
use Modules\Financeiro\Http\Controllers\ContaPagarController;
use Modules\Financeiro\Http\Controllers\ContaReceberController;
use Modules\Financeiro\Http\Controllers\ConciliacaoBancariaController;

Route::middleware(['auth', 'verified'])->group(function () {
    // Contas a Pagar
    Route::resource('contas-pagar', ContaPagarController::class)->names('financeiro.contas-pagar');
    Route::post('contas-pagar/{id}/pagar', [ContaPagarController::class, 'pagar'])->name('financeiro.contas-pagar.pagar');
    
    // Contas a Receber
    Route::resource('contas-receber', ContaReceberController::class)->names('financeiro.contas-receber');
    Route::post('contas-receber/{id}/receber', [ContaReceberController::class, 'receber'])->name('financeiro.contas-receber.receber');
    
    // Conciliação Bancária
    Route::resource('conciliacoes-bancarias', ConciliacaoBancariaController::class)->names('financeiro.conciliacoes-bancarias');
    Route::post('conciliacoes-bancarias/{id}/importar', [ConciliacaoBancariaController::class, 'importar'])->name('financeiro.conciliacoes-bancarias.importar');
    Route::post('conciliacoes-bancarias/{id}/conciliar', [ConciliacaoBancariaController::class, 'conciliar'])->name('financeiro.conciliacoes-bancarias.conciliar');
});
