<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Account
        User::updateOrCreate(
            ['email' => 'admin@pln.co.id'],
            [
                'name' => 'Administrator SKKO',
                'username' => 'admin',
                'email' => 'admin@pln.co.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'unit_kerja' => 'PLN UP 3 Bukittinggi',
                'jabatan' => 'Manajer Konstruksi',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        // Regular User Account
        User::updateOrCreate(
            ['email' => 'user@pln.co.id'],
            [
                'name' => 'User Monitoring',
                'username' => 'user',
                'email' => 'user@pln.co.id',
                'password' => Hash::make('password'),
                'role' => 'user',
                'unit_kerja' => 'PLN UP 3 Bukittinggi',
                'jabatan' => 'Staf Administrasi',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        // Demo Engineer User
        User::updateOrCreate(
            ['email' => 'pengawas@pln.co.id'],
            [
                'name' => 'Budi Santoso',
                'username' => 'bsantoso',
                'email' => 'pengawas@pln.co.id',
                'password' => Hash::make('password'),
                'role' => 'user',
                'unit_kerja' => 'PLN ULP Agam',
                'jabatan' => 'Pengawas Pekerjaan',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
