<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
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
            if($i === 0) continue;
            if (
                empty($row[0]) || empty($row[1]) || empty($row[2]) ||
                Employee::where('email', $row[1])->exists()
            ) {
                continue;
            }
            try {
                Employee::insert([
                    'name' => $row[0],
                    'email' => $row[1],
                    'division_id' => $row[2],
                    'unit_karya_id' => $row[3],
                ]);
            } catch (\Exception $e) {
                info($e->getMessage());
            }
        }
    }
}
