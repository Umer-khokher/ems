<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CustomLoginController;

// Route::get('/check-in-attendance', [AttendanceController::class, 'showCheckInForm']);
Route::post('/check-in-attendance', [AttendanceController::class, 'checkInAttendance'])->name('check-in-attendance');

Route::get('/custom-login', [CustomLoginController::class, 'showLoginForm'])->name('custom.login');
Route::post('/custom-login', [CustomLoginController::class, 'login'])->name('custom.login.submit');


Route::post('/set-password/{user}', [CustomLoginController::class, 'setPassword'])->name('set.password');

Route::post('/LoginForm1', [CustomLoginController::class, 'LoginForm1'])->name('LoginForm1');

Route::get('/', function () {return redirect()->route('custom.login');});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});
route::get('/redirect', [HomeController::class, 'redirect']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/attendance', [AttendanceController::class, 'showForm'])->name('attendance.form');
    Route::post('/attendance', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
    Route::get('/attendance/history', [AttendanceController::class, 'viewHistory'])->name('attendance.history');
    
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/register', [HomeController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [HomeController::class, 'register']);

    Route::get('/attendence', [HomeController::class, 'showusersattendance'])->name('admin.attendence');
    Route::get('/edit', [HomeController::class, 'showeditform'])->name('admin.attendence.edit');
    Route::post('/edit', [HomeController::class, 'submitedit']);

});

Route::get('/logout', function () {
	Session::flush();
    Auth::logout();
	return redirect()->route('custom.login');
});