<?php

use Illuminate\Support\Facades\Route;
use Modules\Financeiro\Http\Controllers\ContaPagarController;
use Modules\Financeiro\Http\Controllers\ContaReceberController;
use Modules\Financeiro\Http\Controllers\ConciliacaoBancariaController;

Route::middleware(['auth', 'verified'])->group(function () {
    // Contas a Pagar
    Route::resource('contas-pagar', ContaPagarController::class)->names('contas-pagar');
    Route::post('contas-pagar/{id}/pagar', [ContaPagarController::class, 'pagar'])->name('contas-pagar.pagar');
    
    // Contas a Receber
    Route::resource('contas-receber', ContaReceberController::class)->names('contas-receber');
    Route::post('contas-receber/{id}/receber', [ContaReceberController::class, 'receber'])->name('contas-receber.receber');
    
    // Conciliação Bancária
    Route::resource('conciliacoes-bancarias', ConciliacaoBancariaController::class)->names('conciliacoes-bancarias');
    Route::post('conciliacoes-bancarias/{id}/importar', [ConciliacaoBancariaController::class, 'importar'])->name('conciliacoes-bancarias.importar');
    Route::post('conciliacoes-bancarias/{id}/conciliar', [ConciliacaoBancariaController::class, 'conciliar'])->name('conciliacoes-bancarias.conciliar');
});
