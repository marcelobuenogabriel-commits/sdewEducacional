<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpresaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalAlunos = \Modules\Aluno\Models\Aluno::count();
    $alunosAtivos = \Modules\Aluno\Models\Aluno::where('status', 'ativo')->count();
    
    $stats = [
        'total_alunos' => $totalAlunos,
        'total_turmas' => \Modules\Turma\Models\Turma::count(),
        'alunos_ativos' => $alunosAtivos,
        'percentual_ativos' => $totalAlunos > 0 ? round($alunosAtivos / $totalAlunos * 100) : 0,
    ];
    
    return view('dashboard', compact('stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Empresa routes
    Route::resource('empresas', EmpresaController::class);
    
    // User management routes
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::get('users/{user}/change-password', [\App\Http\Controllers\UserController::class, 'editPassword'])->name('users.change-password');
    Route::put('users/{user}/change-password', [\App\Http\Controllers\UserController::class, 'updatePassword'])->name('users.update-password');
});

require __DIR__.'/auth.php';
