<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PerformanceController;

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
Route::get('/admin/leave-requests/search', [AdminController::class, 'searchEmployeeRequests'])->name('admin.leaveRequestsSearch');


// admin routes para la vista performance
Route::get('/admin/performance', [AdminController::class, 'viewPerformance'])->name('admin.performance');
Route::post('/admin/performance/filter', [AdminController::class, 'filterPerformance'])->name('admin.performance.filter');
Route::post('/admin/performance/export/{type}', [PerformanceController::class, 'export'])->name('admin.export');
// Employee routes
Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard')->middleware('auth');
Route::post('/employee/check-in', [EmployeeController::class, 'checkIn'])->name('employee.checkin');
Route::post('/employee/check-out', [EmployeeController::class, 'checkOut'])->name('employee.checkout');

Route::get('/employee/request-leave', [EmployeeController::class, 'showRequestLeaveForm'])->name('employee.showRequestLeave');
Route::post('/employee/request-leave', [EmployeeController::class, 'requestLeave'])->name('employee.requestLeave');
Route::get('/employee/leave-requests', [EmployeeController::class, 'viewLeaveRequests'])->name('employee.leaveRequests');
Route::delete('/employee/leave-requests/{id}', [EmployeeController::class, 'deleteLeaveRequest'])->name('employee.deleteLeaveRequest');


//RUTAS PARA RECUPERAR LA CONTRASEÑA DE TU CUENTA
// Ruta para mostrar el formulario de recuperación de contraseña
Route::get('forgot-password', [\App\Http\Controllers\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Ruta para procesar el formulario y enviar el correo de recuperación
Route::post('forgot-password', [\App\Http\Controllers\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Ruta para el formulario donde el usuario introduce su nueva contraseña
Route::get('reset-password/{token}', [\App\Http\Controllers\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    
// Ruta para procesar el restablecimiento de la contraseña
Route::post('reset-password', [\App\Http\Controllers\ResetPasswordController::class, 'reset'])->name('password.update');

/*
Route::group(['middleware' => 'auth'], function() {
    // rutas para el dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/attendance/clock_in', [AttendandeController::class, 'clockIn'])->name('attendance.clock_in');
    Route::post('/attendance/clock_out', [AttendandeController::class, 'clockOut'])->name('attendance.clock_out');
    Route::post('/leave', [LeaveRequestController::class, 'submitLeave'])->name('leave.submit');
});

*/