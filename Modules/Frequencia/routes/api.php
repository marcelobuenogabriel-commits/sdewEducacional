<?php

use Illuminate\Support\Facades\Route;
use Modules\Frequencia\Http\Controllers\FrequenciaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('frequencias', FrequenciaController::class)->names('frequencia');
});
