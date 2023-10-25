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
        DB::table('users')->insert([
            // 'id'=>1,
            'user_first_name' => 'Admin',
            'user_email' => 'admin@admin.in',
            'user_role'=>1,
            'password' =>  Hash::make('admin@123'),
        ]);

        $users = [
          ['id' => '1', 'first_name' => 'Super', 'last_name' => 'Admin',
            'email' => 'developer@insidestorybox.com', 'phone' => "0000000000000",
            'email_verified_at' => Carbon::now(), 'password' => bcrypt('admin@123'), 'gender' => 'MALE', 'user_type' => 'ADMIN', 'status' => '1', 'timezone' => 'Asia/Kolkata', 'created_by' => 1, 'updated_by' => 1, 'deleted_by' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null],
          ['id' => '2', 'first_name' => 'Velammal', 'last_name' => 'Admin', 'email' => 'admin@vblive.co', 'phone' => "0000000000001", 'email_verified_at' => Carbon::now(), 'password' => bcrypt('5Ec5*53*Hywr'), 'gender' => 'MALE', 'user_type' => 'ADMIN', 'status' => '1', 'timezone' => 'Asia/Kolkata', 'created_by' => 1, 'updated_by' => 1, 'deleted_by' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null],
        ]

        );
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
