<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123'),
                'role' => 'admin'
            ]
        );

        User::updateOrCreate(
            ['email' => 'pimpinan@gmail.com'],
            [
                'name' => 'Pimpinan',
                'password' => Hash::make('123'),
                'role' => 'pimpinan'
            ]
        );

        User::updateOrCreate(
            ['email' => 'karyawan@gmail.com'],
            [
                'name' => 'Karyawan',
                'password' => Hash::make('123'),
                'role' => 'karyawan'
            ]
        );
    }
}