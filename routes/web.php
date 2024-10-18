<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

/*
Route::get('/', function () {
    return view('login');
});
*/

//rutas para el dashboard con middleware
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);


//rutas para la raiz
Route::get('/',[LoginController::class, 'show']);


//  rutas para el login
Route::get('/login',[LoginController::class, 'show'])->name('login');
Route::post('/login',[LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'] )->name('logout');

// rutas para el register
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// rutas para el dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
