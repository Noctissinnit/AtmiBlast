<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeImport;
use App\Models\Division;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
        public function index()
    {
        $employees = Employee::with('division')->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $divisions = Division::all();
        return view('employees.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'division_id' => 'required|exists:divisions,id',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
    
}
