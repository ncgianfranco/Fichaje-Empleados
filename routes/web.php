<?php

use App\Http\Controllers\AttendandeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Models\AdminController;
use App\Models\EmployeeController;
use App\Models\LeaveRequest;

//rutas para la raiz
Route::get('/',[LoginController::class, 'show']);


//  rutas para el login
Route::get('/login',[LoginController::class, 'show'])->name('login');
Route::post('/login',[LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'] )->name('logout');

// rutas para el register
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


// ruta para redirigir a la ruta dependiendo del role
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Admin routes
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manageUsers');
});

// Employee routes
Route::group(['middleware' => ['auth', 'role:employee']], function () {
    Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
    Route::get('/employee/timesheet', [EmployeeController::class, 'viewTimesheet'])->name('employee.timesheet');
});


/*
Route::group(['middleware' => 'auth'], function() {
    // rutas para el dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/attendance/clock_in', [AttendandeController::class, 'clockIn'])->name('attendance.clock_in');
    Route::post('/attendance/clock_out', [AttendandeController::class, 'clockOut'])->name('attendance.clock_out');
    Route::post('/leave', [LeaveRequestController::class, 'submitLeave'])->name('leave.submit');
});

*/