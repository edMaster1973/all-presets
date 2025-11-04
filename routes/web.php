<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordChangeController;

/*
|--------------------------------------------------------------------------
| Web Routes - Alterar Senha
|--------------------------------------------------------------------------
|
| Aqui estão definidas as rotas web para a funcionalidade de alteração de senha.
| Estas rotas são utilizadas para exibir o formulário e processar a alteração.
|
*/

// Rotas para alteração de senha (requer autenticação)
Route::middleware(['auth'])->group(function () {
    // Exibe o formulário de alteração de senha
    Route::get('/password/change', [PasswordChangeController::class, 'showChangeForm'])
        ->name('password.change.form');
    
    // Processa a alteração de senha
    Route::post('/password/change', [PasswordChangeController::class, 'changePassword'])
        ->name('password.change.update');
});

/*
|--------------------------------------------------------------------------
| Rotas Adicionais (Opcional)
|--------------------------------------------------------------------------
|
| Caso queira acessar sem autenticação para testes, descomente abaixo:
|
*/

// Route::get('/password/change', [PasswordChangeController::class, 'showChangeForm'])
//     ->name('password.change.form');
// Route::post('/password/change', [PasswordChangeController::class, 'changePassword'])
//     ->name('password.change.update');
