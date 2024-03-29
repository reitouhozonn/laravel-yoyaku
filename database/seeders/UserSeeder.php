<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('123'),
                'role' => 1
            ],
            [
                'name' => 'manager',
                'email' => 'manager@example.com',
                'password' => Hash::make('123'),
                'role' => 5
            ],
            [
                'name' => 'test',
                'email' => 'test@example.com',
                'password' => Hash::make('123'),
                'role' => 9
            ]

        ]);
    }
}
