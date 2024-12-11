<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ResetPasswordController;

// Rutas para la raíz
Route::get('/', [LoginController::class, 'show']);

// Rutas de autenticación
Route::group([], function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Rutas protegidas
Route::middleware(['auth.custom'])->group(function () {
    // Redirección según el rol
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas de administrador
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/employee/add', [AdminController::class, 'addEmployee'])->name('addEmployee');
        Route::post('/employee/add', [AdminController::class, 'storeEmployee'])->name('storeEmployee');
        Route::get('/employee/{id}/edit', [AdminController::class, 'editEmployee'])->name('editEmployee');
        Route::put('/employee/{id}', [AdminController::class, 'updateEmployee'])->name('updateEmployee');
        Route::delete('/employee/{id}', [AdminController::class, 'deleteEmployee'])->name('deleteEmployee');
        Route::get('/leave-requests', [AdminController::class, 'viewLeaveRequests'])->name('leaveRequests');
        Route::put('/leave-requests/{id}', [AdminController::class, 'updateLeaveStatus'])->name('updateLeaveStatus');
        Route::get('/leave-requests/search', [AdminController::class, 'searchEmployeeRequests'])->name('leaveRequestsSearch');
        Route::get('/performance', [AdminController::class, 'viewPerformance'])->name('performance');
        Route::post('/performance/filter', [AdminController::class, 'filterPerformance'])->name('performance.filter');
        Route::post('/performance/export/{type}', [PerformanceController::class, 'export'])->name('export');
    });

    // Rutas de empleado
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
        Route::post('/check-in', [EmployeeController::class, 'checkIn'])->name('checkin');
        Route::post('/check-out', [EmployeeController::class, 'checkOut'])->name('checkout');
        Route::get('/request-leave', [EmployeeController::class, 'showRequestLeaveForm'])->name('showRequestLeave');
        Route::post('/request-leave', [EmployeeController::class, 'requestLeave'])->name('requestLeave');
        Route::get('/leave-requests', [EmployeeController::class, 'viewLeaveRequests'])->name('leaveRequests');
        Route::delete('/leave-requests/{id}', [EmployeeController::class, 'deleteLeaveRequest'])->name('deleteLeaveRequest');
    });
});

// Rutas para recuperación de contraseña
Route::prefix('password')->name('password.')->group(function () {
    Route::get('forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('request');
    Route::post('forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('email');
    Route::get('reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('reset');
    Route::post('reset', [ResetPasswordController::class, 'reset'])->name('update');
});


