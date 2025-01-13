<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       // Abaikan baris yang tidak lengkap
       if (empty($row['name']) || empty($row['email']) || empty($row['division_id'])) {
        return null;
        }

        // Abaikan jika email sudah ada
        if (Employee::where('email', $row['email'])->exists()) {
            return null;
        }

        return new Employee([
            'name' => $row['name'],
            'email' => $row['email'],
            'division_id' => $row['division_id'],
        ]);
    }
}
