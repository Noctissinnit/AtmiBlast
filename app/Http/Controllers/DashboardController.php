<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Employee;
use App\Models\UnitKarya;

class DashboardController extends Controller
{
    public function index()
    {
        $divisionsCount = Division::count();
        $employeesCount = Employee::count();
        $unitsCount = UnitKarya::count();
        return view('dashboard', compact('divisionsCount', 'employeesCount', 'unitsCount'));
    }
}
