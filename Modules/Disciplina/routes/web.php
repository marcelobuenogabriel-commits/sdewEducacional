<?php

use Illuminate\Support\Facades\Route;
use Modules\Disciplina\Http\Controllers\DisciplinaController;

Route::middleware(['auth'])->group(function () {
    Route::resource('disciplinas', DisciplinaController::class);
});
