<?php

use Illuminate\Support\Facades\Route;
use Modules\Professor\Http\Controllers\ProfessorController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('professors', ProfessorController::class)->names('professor');
});
