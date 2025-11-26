<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin PPDB',
                'email' => 'admin@ppdb.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Verifikator PPDB',
                'email' => 'verifikator@ppdb.com',
                'password' => Hash::make('password'),
                'role' => 'verifikator',
            ],
            [
                'name' => 'Keuangan PPDB',
                'email' => 'keuangan@ppdb.com',
                'password' => Hash::make('password'),
                'role' => 'keuangan',
            ],
            [
                'name' => 'Kepala Sekolah',
                'email' => 'kepsek@ppdb.com',
                'password' => Hash::make('password'),
                'role' => 'kepala_sekolah',
            ],
            [
                'name' => 'Calon Siswa',
                'email' => 'siswa@ppdb.com',
                'password' => Hash::make('password'),
                'role' => 'calon_siswa',
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}