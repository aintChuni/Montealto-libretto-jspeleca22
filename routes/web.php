<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthViewController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', [AuthViewController::class, 'showRegister'])->name('register');
Route::get('/login', [AuthViewController::class, 'showLogin'])->name('login');

Route::post('/web-login', [LoginController::class, 'authenticate'])->name('web.login');
Route::post('/web-register', [LoginController::class, 'register'])->name('web.register');

Route::middleware('auth:sanctum')->group(function () {
    Route::resources([
        'authors' => AuthorController::class,
        'books' => BookController::class,
        'genres' => GenreController::class,
        'reviews' => ReviewController::class,
    ]);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
