<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class EmployeeImport implements ToCollection
{
    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'email';
    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $i => $row) {

            if (empty($row['name']) || empty($row['email']) || empty($row['division_id']) ||
                Employee::where('email', $row['email'])->exists()) {
            }
            try {
                Employee::insert([
                    'name' => $row[0],
                    'email' => $row[1],
                    'division_id' => $row[2],
                ]);
            } catch (\Exception $e) {
                info($e->getMessage());
            }
        }
    }
}
