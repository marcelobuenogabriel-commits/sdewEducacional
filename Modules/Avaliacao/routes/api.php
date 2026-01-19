<?php

use Illuminate\Support\Facades\Route;
use Modules\Avaliacao\Http\Controllers\AvaliacaoController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('avaliacaos', AvaliacaoController::class)->names('avaliacao');
});
