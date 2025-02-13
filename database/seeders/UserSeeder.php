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
     */
    public function run(): void
    {
        $arr = [
            [
                'full_name' => 'john donn',
                'role' => 2,
                'email' => 'johndonn@gmail.com',
                'password' => Hash::make('qwerty123')
            ],
            [
                'full_name' => 'Will Smit',
                'role' => 2,
                'email' => 'willsmit@gmail.com',
                'password' => Hash::make('qwerty123')
            ],
            [
                'full_name' => 'Joen Doen',
                'role' => 2,
                'email' => 'joendoen@gmail.com',
                'password' => Hash::make('qwerty123')
            ],
            [
                'full_name' => 'Its me Mario',
                'role' => 2,
                'email' => 'mario@gmail.com',
                'password' => Hash::make('qwerty123')
            ]
        ];

        foreach($arr as $user){
            DB::table('users')->insert([
                'full_name' => $user['full_name'],
                'role' => $user['role'],
                'email' => $user['email'],
                'password' => $user['password']
            ]);
        }
    }
}
