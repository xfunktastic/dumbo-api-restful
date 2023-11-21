<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminTableSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => '',
            'lastname' => '',
            'username' => 'Ochietto',
            'email' => '',
            'password' => bcrypt('Jaqamain3pals'),
            'rut_dni' => 'admin',
            'points' => 0,
            'role' => 'admin',
        ]);
    }

}
