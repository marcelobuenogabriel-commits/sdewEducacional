<?php

use Illuminate\Support\Facades\Route;
use Modules\Comunicacao\Http\Controllers\MensagemController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('mensagens', MensagemController::class)->names('mensagens');
    
    // Additional routes for messaging features
    Route::post('mensagens/{id}/marcar-lida', [MensagemController::class, 'marcarLida'])->name('mensagens.marcar-lida');
    Route::post('mensagens/{id}/arquivar', [MensagemController::class, 'arquivar'])->name('mensagens.arquivar');
    Route::get('mensagens/enviadas', [MensagemController::class, 'enviadas'])->name('mensagens.enviadas');
    Route::get('mensagens/recebidas', [MensagemController::class, 'recebidas'])->name('mensagens.recebidas');
});
