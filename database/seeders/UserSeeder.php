<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'User 1',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'name' => 'User 3',
                'email' => 'user3@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
        ];

        DB::table('users')->insert($users);
    }
}
