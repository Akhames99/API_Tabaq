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
            ['phone_number' => '01226397243', 'password_hash' => Hash::make('ak123654'), 'name' => 'Ahmed Khames'],
            ['phone_number' => '01226397242', 'password_hash' => Hash::make('mh123654'), 'name' => 'Mohamed Helal'],
            ['phone_number' => '01226397241', 'password_hash' => Hash::make('im123654'), 'name' => 'Islam Fouad'],
            ['phone_number' => '01226397240', 'password_hash' => Hash::make('am123654'), 'name' => 'Ahmed Mosaad'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}