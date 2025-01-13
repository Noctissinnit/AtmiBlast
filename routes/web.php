<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmployeeController;

//route homepage
Route::get('/', function () {
    return view('index');
})->name('homepage');

//Route Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});


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
Route::post('/employees/import', [EmployeeController::class, 'importExcel'])->name('employees.import');



//Route Employee


Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
