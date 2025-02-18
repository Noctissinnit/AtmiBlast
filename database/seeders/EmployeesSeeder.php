<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(0, 6) as $i){
            Employee::insert([
                'nis' => $faker->numerify("#########"),
                'name' => $faker->name(),
                'email' => "anjingsedboi@gmail.com",
                'division_id' => 1, // Division: PT
            ]);
        }
    }
}
