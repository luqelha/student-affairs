<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Alya Nadhira',
                'nim' => '2021101001',
                'email' => 'alya.nadhira@kemahasiswaan.uin',
            ],
            [
                'name' => 'Zayden Arga',
                'nim' => '2021101002',
                'email' => 'zayden.arga@kemahasiswaan.uin',
            ],
            [
                'name' => 'Kaela Putri',
                'nim' => '2021101003',
                'email' => 'kaela.putri@kemahasiswaan.uin',
            ],
            [
                'name' => 'Rafly Ezra',
                'nim' => '2021101004',
                'email' => 'rafly.ezra@kemahasiswaan.uin',
            ],
            [
                'name' => 'Naira Azzahra',
                'nim' => '2021101005',
                'email' => 'naira.azzahra@kemahasiswaan.uin',
            ],
            [
                'name' => 'Elio Rayhan',
                'nim' => '2021101006',
                'email' => 'elio.rayhan@kemahasiswaan.uin',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'nim' => $user['nim'],
                    'password' => Hash::make('user123'),
                    'role' => 'user',
                ]
            );
        }
    }
}
