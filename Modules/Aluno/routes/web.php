<?php

use Illuminate\Support\Facades\Route;
use Modules\Aluno\Http\Controllers\AlunoController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('alunos', AlunoController::class)->names('aluno');
});
