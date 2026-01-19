<?php

use Illuminate\Support\Facades\Route;
use Modules\Relatorio\Http\Controllers\RelatorioController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('relatorios', RelatorioController::class)->names('relatorio');
});
