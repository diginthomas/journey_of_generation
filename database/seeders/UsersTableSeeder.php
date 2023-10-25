<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // 'id'=>1,
            'user_first_name' => 'Admin',
            'user_email' => 'admin@admin.in',
            'user_role'=>1,
            'password' =>  Hash::make('admin@123'),
        ]);
    }
}
