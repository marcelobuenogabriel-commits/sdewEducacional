<?php

use Illuminate\Support\Facades\Route;
use Modules\Turma\Http\Controllers\TurmaController;

Route::middleware(['auth'])->group(function () {
    Route::resource('turmas', TurmaController::class);
});
