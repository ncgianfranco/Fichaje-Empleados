<?php

use App\Http\Controllers\AttendandeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
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
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');

Route::get('/admin/employee/add', [AdminController::class, 'addEmployee'])->name('admin.addEmployee');
Route::post('/admin/employee/add', [AdminController::class, 'storeEmployee'])->name('admin.storeEmployee');

Route::get('/admin/employee/{id}/edit', [AdminController::class, 'editEmployee'])->name('admin.editEmployee');
Route::put('/admin/employee/{id}', [AdminController::class, 'updateEmployee'])->name('admin.updateEmployee');

Route::delete('/admin/employee/{id}', [AdminController::class, 'deleteEmployee'])->name('admin.deleteEmployee');

Route::get('/admin/leave-requests', [AdminController::class, 'viewLeaveRequests'])->name('admin.leaveRequests');
Route::put('/admin/leave-requests/{id}', [AdminController::class, 'updateLeaveStatus'])->name('admin.updateLeaveStatus');


// Employee routes
Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard')->middleware('auth');
Route::post('/employee/check-in', [EmployeeController::class, 'checkIn'])->name('employee.checkin');
Route::post('/employee/check-out', [EmployeeController::class, 'checkOut'])->name('employee.checkout');

Route::get('/employee/request-leave', [EmployeeController::class, 'showRequestLeaveForm'])->name('employee.showRequestLeave');
Route::post('/employee/request-leave', [EmployeeController::class, 'requestLeave'])->name('employee.requestLeave');
Route::get('/employee/leave-requests', [EmployeeController::class, 'viewLeaveRequests'])->name('employee.leaveRequests');
Route::delete('/employee/leave-requests/{id}', [EmployeeController::class, 'deleteLeaveRequest'])->name('employee.deleteLeaveRequest');

/*
Route::group(['middleware' => 'auth'], function() {
    // rutas para el dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/attendance/clock_in', [AttendandeController::class, 'clockIn'])->name('attendance.clock_in');
    Route::post('/attendance/clock_out', [AttendandeController::class, 'clockOut'])->name('attendance.clock_out');
    Route::post('/leave', [LeaveRequestController::class, 'submitLeave'])->name('leave.submit');
});

*/