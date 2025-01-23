<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        // Insert data into divisions table
        DB::table('divisions')->insert([
            ['id' => 1, 'name' => 'PT'],
            ['id' => 2, 'name' => 'Yay'],
        ]);

        // Data for users and employees
        $users = [
            [
                'name' => 'Arthur',
                'email' => 'arthur1@example.com',
                'password' => Hash::make('password'), // Replace 'password' with your preferred password
                'division_id' => 1, // Division: PT
            ],
            [
                'name' => 'Arthur',
                'email' => 'arthur2@example.com',
                'password' => Hash::make('password'), // Replace 'password' with your preferred password
                'division_id' => 2, // Division: Yay
            ],
        ];

        foreach ($users as $user) {
            // Insert user and get ID
            $userId = DB::table('users')->insertGetId([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);

            // Insert employee linked to user and division
            DB::table('employees')->insert([
                'userid' => $userId,
                'division_id' => $user['division_id'],
            ]);
        }
    }
}
