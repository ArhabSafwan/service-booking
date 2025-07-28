<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Arhab Safwan',
            'email' => 'asafwan72@gmail.com',
            'password' => Hash::make('123456'),
            'is_admin' => 1,
        ]);

        // Customer User
        User::create([
            'name' => 'Qtech',
            'email' => 'qtecdev.careers@gmail.com',
            'password' => Hash::make('123456'),
            'is_admin' => 0,
        ]);
    }
}
