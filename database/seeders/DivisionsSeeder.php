<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Division::insert([
            ['name' => 'PT'],
            ['name' => 'Yay'],
            ['name' => 'Org'],
            ['name' => 'Sales'],
            ['name' => 'Dev'],
        ]);
    }
}
