<?php

use App\Http\Controllers\EquipamentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\FileController::class, 'home'])->name('home');

Route::get('/tones', function () {
    return view('tones');
})->name('tones');

Route::get('/logar', function () {
    return view('login');
})->name('entrar');

Route::get('/registrar_se', [App\Http\Controllers\UserController::class, 'create'])->name('registrar_se');

Route::post('/user-store', [App\Http\Controllers\UserController::class, 'store'])->name('registrar_se.store');

Route::get('/share/{file}', [App\Http\Controllers\FileController::class, 'share'])->name('share.file');

Route::middleware('auth')->group(function () {

    Route::get('/inicio', [App\Http\Controllers\FileController::class, 'inicio'])->name('inicio');

    // Route::get('/inicio', function () {
    //     return view('inicio');
    // })->name('inicio');

    Route::get('/meus_dados', function () {
        return view('meus_dados');
    })->name('meus_dados');

    Route::get('/altera_senha', function () {
        return view('altera_senha');
    })->name('altera_senha');

    Route::get('/saiba_mais/{file}', [App\Http\Controllers\FileController::class, 'show'])->name('saiba_mais');

    Route::put('/update_password', [App\Http\Controllers\PasswordController::class, 'updatePassword'])->name('update_password');

    Route::put('/foto_perfil', [App\Http\Controllers\UserController::class, 'foto'])->name('foto_perfil');

    Route::get('/upload', [App\Http\Controllers\FileController::class, 'index'])->name('upload');

    Route::post('/file-store', [App\Http\Controllers\FileController::class, 'store'])->name('file.store');

    Route::get('/upload/{id}', [App\Http\Controllers\FileController::class, 'create'])->name('upload.segment');

    Route::get('/equipaments/por-marca/{marca_id}', [EquipamentController::class, 'getEquipamentosPorMarca'])->name('equipaments.por.marca');

    Route::post('/download-arquivos', [App\Http\Controllers\FileController::class, 'downloadZip'])->name('download.arquivos');

    Route::post('/like', [App\Http\Controllers\LikeController::class, 'store'])->name('like.store');

    Route::delete('/like/{like}', [App\Http\Controllers\LikeController::class, 'destroy'])->name('like.destroy');

    Route::post('/comment-store', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');

    Route::post('/file/{file}/share', [App\Http\Controllers\ShareController::class, 'generateLink'])->name('file.share');

    Route::get('/download/{share_id}', [App\Http\Controllers\ShareController::class, 'downloadFile'])->name('file.download.signed');

    Route::post('/user/{user}/follow', [App\Http\Controllers\FollowController::class, 'toggleFollow'])->name('user.follow');

    Route::post('/search_files', [App\Http\Controllers\FileController::class, 'searchFiles'])->name('search.files');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';