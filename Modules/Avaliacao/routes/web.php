<?php

use Illuminate\Support\Facades\Route;
use Modules\Avaliacao\Http\Controllers\AvaliacaoController;

Route::middleware(['auth'])->group(function () {
    Route::resource('avaliacoes', AvaliacaoController::class);
});
