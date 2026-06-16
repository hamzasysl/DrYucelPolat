<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'mezbilisim'],
            [
                'name'      => 'Mez Bilişim',
                'email'     => 'info@dryucelpolat.com',
                'password'  => Hash::make('1234qwer%&/mezLARAVELq'),
                'role'      => User::ROLE_ADMIN,
                'is_active' => true,
            ]
        );
    }
}
