<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Data for users and employees
        $users = [
            [
                'name' => 'Arthur',
                'email' => 'arthur1@example.com',
                'password' => Hash::make('password'), // Replace 'password' with your preferred password
                'institusi_id' => 1, // Division: PT
            ],
            [
                'name' => 'Arthur',
                'email' => 'arthur2@example.com',
                'password' => Hash::make('password'), // Replace 'password' with your preferred password
                'institusi_id' => 2, // Division: Yay
            ],
        ];

        foreach ($users as $user) {
            // Insert user and get ID
            $userId = User::insertGetId([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);

            // Insert employee linked to user and division
            Employee::insert([
                'userid' => $userId,
                'institusi_id' => $user['institusi_id'],
            ]);
        }
    }
}
