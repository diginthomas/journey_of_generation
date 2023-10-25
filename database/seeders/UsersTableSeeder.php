<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $users = [
          ['id' => '1', 'first_name' => 'Super', 'last_name' => 'Admin', 'email' => 'developer@gamil.com', 'phone' => "0000000000000", 'email_verified_at' => Carbon::now(), 'password' => bcrypt('admin@123'), 'gender' => 'MALE', 'status' => '1', 'role' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null],
          ['id' => '2', 'first_name' => 'Admin', 'last_name' => 'Admin', 'email' => 'admin@gmail.com', 'phone' => "0000000000001", 'email_verified_at' => Carbon::now(), 'password' => bcrypt('admin@123'), 'gender' => 'MALE', 'status' => '1', 'role' => '1','created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null],

      ];

      foreach ($users as $key => $value) {
        $exists = User::withTrashed()->where('id', $value['id'])->first(); // considering softdeleted entry
        if ($exists) {
            unset($users[$key]);
        }
    }

    $users = array_values($users);
    DB::table('users')->insert($users);
    
    }
}
