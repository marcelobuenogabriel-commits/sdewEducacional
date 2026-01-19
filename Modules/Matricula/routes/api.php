<?php

use Illuminate\Support\Facades\Route;

Route::get('/matricula', function () {
    return response()->json(['message' => 'Matricula API']);
});
