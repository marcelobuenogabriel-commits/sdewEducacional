<?php

use Illuminate\Support\Facades\Route;
use Modules\Disciplina\Http\Controllers\DisciplinaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('disciplinas', DisciplinaController::class)->names('disciplina');
});
