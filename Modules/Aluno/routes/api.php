<?php

use Illuminate\Support\Facades\Route;
use Modules\Aluno\Http\Controllers\AlunoController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('alunos', AlunoController::class)->names('aluno');
});
