<?php

use Illuminate\Support\Facades\Route;
use Modules\Frequencia\Http\Controllers\FrequenciaController;

Route::middleware(['auth'])->group(function () {
    Route::resource('frequencias', FrequenciaController::class);
});
