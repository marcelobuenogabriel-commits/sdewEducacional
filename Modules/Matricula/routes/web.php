<?php

use Illuminate\Support\Facades\Route;
use Modules\Matricula\Http\Controllers\MatriculaController;

Route::middleware(['auth'])->group(function () {
    Route::resource('matriculas', MatriculaController::class);
    Route::post('matriculas/matricular', [MatriculaController::class, 'matricular'])->name('matriculas.matricular');
});
