<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "test",
            "email" => "test@gmail.com",
            "password" => bcrypt("123456789"),
            'status' => "Activo"
        ]);
        User::create([
            "name" => "inactivo",
            "email" => "inactivo@gmail.com",
            "password" => bcrypt("123456789"),
            'status' => "Inactivo"
        ]);
    }
}
