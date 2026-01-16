<?php

use Illuminate\Support\Facades\Route;
use Modules\Professor\Http\Controllers\ProfessorController;

Route::middleware(['auth'])->group(function () {
    Route::resource('professores', ProfessorController::class);
});
