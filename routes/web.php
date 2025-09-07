<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmFrontendController;
use App\Http\Controllers\Web\AuthWebController;

Route::redirect('/', '/register');

Route::get('/login', [AuthWebController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthWebController::class, 'login']);

Route::get('/register', [AuthWebController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthWebController::class, 'register']);

Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/films', [FilmFrontendController::class, 'index'])->name('films.index.page');
    Route::get('/films/create', [FilmFrontendController::class, 'create'])->name('films.create');
    Route::get('/films/search', [FilmFrontendController::class, 'search'])->name('films.search');
    Route::post('/films', [FilmFrontendController::class, 'store'])->name('films.store.page');
});
