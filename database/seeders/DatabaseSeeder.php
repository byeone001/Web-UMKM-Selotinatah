<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@selotinatah.desa.id'],
            [
                'name' => 'Admin Selotinatah',
                'password' => Hash::make('selotinatahumkm'),
                'role' => 'admin',
            ],
        );

        foreach ([
            'ceraromaticitrus@gmail.com' => 'Ceraromaticitrus',
            'pselotinatah@gmail.com' => 'P Selotinatah',
        ] as $email => $name) {
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make('selotinatahumkm'),
                    'role' => 'admin',
                ],
            );
        }
    }
}
