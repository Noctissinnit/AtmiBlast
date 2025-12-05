<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeImport;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Institusi;
use App\Models\UnitKarya;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::with(['institusi', 'unitKarya'])->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
         // Ambil semua divisi
        
        $divisions = Institusi::all();

        // Jika ada divisi yang dipilih sebelumnya, ambil unit karya yang terkait dengan divisi tersebut
        $units = collect();
        if (old('division_id')) {
            $units = UnitKarya::where('division_id', old('division_id'))->get();
        }

        // Mengirim data divisi dan unit karya ke tampilan
        return view('employees.create', compact('divisions', 'units'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'division_id' => 'required|exists:divisions,id',
            'unit_karya_id' => 'required|exists:unit_karyas,id',
        ]);

        // Simpan data employee ke database
        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'division_id' => $request->division_id,
            'unit_karya_id' => $request->unit_karya_id,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }

    public function importExcel(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'excel' => 'required|mimes:xlsx,xls',
        ]);

        try {
            // Hapus semua data dari tabel employees
            Employee::truncate();

            // Reset auto-increment ID pada tabel employees
            DB::statement('ALTER TABLE employees AUTO_INCREMENT = 1');

            // Proses file Excel menggunakan EmployeeImport
            $import = Excel::import(new EmployeeImport, $request->file('excel'));

            // Mengecek apakah proses impor berhasil
            if ($import) {
                return redirect()->route('employees.index')->with('success', 'Data berhasil diimpor dan ID dimulai dari 1!');
            } else {
                return redirect()->route('employees.index')->with('error', 'Gagal mengimpor data.');
            }
        } catch (\Exception $e) {
            // Tangani kesalahan dengan mengembalikan pesan error
            return redirect()->route('employees.index')->with('error', 'Terjadi kesalahan saat memproses file Excel: ' . $e->getMessage());
        }
    }
}
