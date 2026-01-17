<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\ProfileType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Yuri',
            'email' => 'yurirene@gmail.com',
            'password' => Hash::make('123'),
            'profile_type' => ProfileType::ADMIN,
        ]);
    }
}
