<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuário padrão
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Usuário Padrão',
                'password' => Hash::make('123456'),
                'type' => UserType::USER,
            ]
        );

        // Técnico padrão
        User::firstOrCreate(
            ['email' => 'tech@example.com'],
            [
                'name' => 'Técnico Padrão',
                'password' => Hash::make('123456'),
                'type' => UserType::TECH,
            ]
        );
    }
}
