<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(AuthMiddleware::class)->group(static function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');
});

Route::view('login', 'auth.login')->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
