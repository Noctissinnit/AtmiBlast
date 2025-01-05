<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmployeeController;

//Route Auth
// Rute untuk menampilkan form login
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

// Rute untuk mengirim data login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Rute untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Route dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Route Divisi
Route::resource('divisions', DivisionController::class)->middleware('auth');
Route::resource('divisions', DivisionController::class);



//Route Email
Route::get('/send-email', [EmailController::class, 'create'])->name('send-email.create');
Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('send-email.post');

//Route Import Excel



//Route Employee


Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
