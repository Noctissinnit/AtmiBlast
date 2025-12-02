<?php

namespace Database\Seeders;


use App\Models\Institusi;
use Illuminate\Database\Seeder;

class InstitusiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Institusi::insert([
            ['name' => 'PT'],
            ['name' => 'Yay'],
            ['name' => 'Org'],
            ['name' => 'Sales'],
            ['name' => 'Dev'],
        ]);
    }
}
