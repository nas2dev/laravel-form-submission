<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');
        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'role' => 'admin',
                'email' => 'admin@admin.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'User1',
                'last_name' => 'Test',
                'role' => 'user',
                'email' => 'user1@user.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'User2',
                'last_name' => 'Test',
                'role' => 'user',   
                'email' => 'user2@user.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'User3',
                'last_name' => 'Test',
                'role' => 'user',
                'email' => 'user3@user.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'User4',
                'last_name' => 'Test',
                'role' => 'user',
                'email' => 'user4@user.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'User5',
                'last_name' => 'Test',
                'role' => 'user',
                'email' => 'user5@user.com',
                'password' => $password,    
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'User6',
                'last_name' => 'Test',
                'role' => 'user',
                'email' => 'user6@user.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'User7',
                'last_name' => 'Test',
                'role' => 'user',
                'email' => 'user7@user.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'User8',
                'last_name' => 'Test',
                'role' => 'user',
                'email' => 'user8@user.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'User9',
                'last_name' => 'Test',
                'role' => 'user',
                'email' => 'user9@user.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

       DB::table('users')->insert($users);
    }
}
