<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'admin',
            'email' => 'admin.kome@gmail.com',
            'password' => bcrypt('id7Djmjbv1'), 
            'role' => 'admin',
        ]);
    }
}
