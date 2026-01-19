<?php

use Illuminate\Support\Facades\Route;
use Modules\Relatorio\Http\Controllers\RelatorioController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('relatorios', RelatorioController::class)->names('relatorio');
});
