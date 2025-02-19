<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\UnitKarya;
use Illuminate\Database\Seeder;

class UnitKaryaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(0, 9) as $i) {
            UnitKarya::insert(['nama_unit_karya' => "Unit Karya $i", 'division_id' => random_int(1, 5)]);
        }
    }
}
