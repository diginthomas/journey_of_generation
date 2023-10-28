<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Picnic;
use DB;
class PicnicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $picnics = [
        ['id'=>1,'title'=>'Summer Trip','location'=>'Goa','image'=>'sample.jpg','date'=> Carbon::now(),'description'=>'summer trip,good climate','agenda'=>'Mental health'],
        ['id'=>2,'title'=>'Winter Trip','location'=>'Kashmir','image'=>'sample.jpg','date'=> Carbon::now(),'description'=>'winter trip,good climate','agenda'=>'Mental health']
    ];
    foreach ($picnics as $key => $value) {
        $exists = Picnic::withTrashed()->where('id', $value['id'])->first(); // considering softdeleted entry
        if ($exists) {
            unset($picnics[$key]);
        }
    }

    $picnics = array_values($picnics);
    DB::table('picnics')->insert($picnics);

    }
}
