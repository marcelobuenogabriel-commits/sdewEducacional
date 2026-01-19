<?php

use Illuminate\Support\Facades\Route;
use Modules\Aluno\Http\Controllers\AlunoController;

Route::middleware(['auth'])->group(function () {
    Route::resource('alunos', AlunoController::class);
});
