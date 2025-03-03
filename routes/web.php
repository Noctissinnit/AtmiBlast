<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UnitKaryaController;
use App\Models\Employee;
use App\Models\UnitKarya;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

// Route Homepage
Route::get('/', function () {
    return view('index');
})->name('homepage');

// Route Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Route Dashboard (Hanya untuk pengguna yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/set-email', function () {
        return view('set_email');
    })->name('setemail');

    // Route Divisi (CRUD)
    Route::resource('divisions', DivisionController::class);

    // Route Employee (CRUD)
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // Route Import Excel untuk Employee
    Route::post('/employees/import', [EmployeeController::class, 'importExcel'])->name('employees.import');

    // Route Search Employee
    



    // Route Email
    Route::get('/email/individual', [EmailController::class, 'showIndividualForm'])->name('email.individual');
    Route::post('/email/individual', [EmailController::class, 'sendToIndividual'])->name('email.sendIndividual');

    Route::get('/email/division', [EmailController::class, 'showDivisionForm'])->name('email.division');
    Route::post('/email/division', [EmailController::class, 'sendToDivision'])->name('email.sendDivision');

    //Route Melihat Unit karya dalam Divisi
    Route::get('/divisions/{division}/units', [DivisionController::class, 'showUnits'])->name('divisions.units');


    Route::get('/email/unit', [EmailController::class, 'showUnitForm'])->name('email.unit');
    Route::post('/email/unit', [EmailController::class, 'sendToUnit'])->name('email.sendUnit');

    // API untuk mendapatkan unit karya berdasarkan divisi (untuk AJAX)
    Route::get('/units-by-division/{division_id}', [EmployeeController::class, 'getUnitsByDivision']);

    // Route Unit Karya
    Route::get('/units/create', [UnitKaryaController::class, 'create'])->name('units.create');
    Route::post('/units', [UnitKaryaController::class, 'store'])->name('units.store');

    //Route ajax unit karya id
    // web.php (Routes)
    Route::get('/get-units/{division_id}', function ($division_id) {
        $units = UnitKarya::where('division_id', $division_id)->get();
        return response()->json(['units' => $units]);
    });
    
    //Route fungsi loading queue
    Route::get('/queue-status', function () {
        $jobCount = DB::table('jobs')->count();
        return response()->json(['jobs' => $jobCount]);
    });

});
