<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/tones', function () {
    return view('tones');
})->name('tones');

Route::get('/logar', function () {
    return view('login');
})->name('entrar');

Route::middleware('auth')->group(function () {
    Route::get('/inicio', function () {
        return view('inicio');
    })->name('inicio');
    Route::get('/meus_dados', function () {
        return view('meus_dados');
    })->name('meus_dados');
    Route::get('/altera_senha', function () {
        return view('altera_senha');
    })->name('altera_senha');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';