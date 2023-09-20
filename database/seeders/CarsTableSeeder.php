<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Make;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $audi = Make::where('name', 'Audi')->first();
        $toyota = Make::where('name', 'Toyota')->first();
        $honda = Make::where('name', 'Honda')->first();
        $mercedes = Make::where('name', 'Mercedes')->first();
    
        DB::table('cars')->insert([
            ['make_id' => $audi->id, 'model_and_year' => 'Q8, 2018', 'color' => 'White'],
            ['make_id' => $audi->id, 'model_and_year' => 'A1, 2010', 'color' => 'Red'],
            ['make_id' => $toyota->id, 'model_and_year' => 'RAV4, 2019', 'color' => 'White'],
            ['make_id' => $toyota->id, 'model_and_year' => 'Prius, 2013', 'color' => 'Blue'],
            ['make_id' => $toyota->id, 'model_and_year' => 'Corolla, 2014', 'color' => 'Blue'],
            ['make_id' => $honda->id, 'model_and_year' => 'Civic, 2017', 'color' => 'Red'],
            ['make_id' => $mercedes->id, 'model_and_year' => 'A-Class, 2018', 'color' => 'White'],
            ['make_id' => $mercedes->id, 'model_and_year' => 'GLA, 2013', 'color' => 'Black'],
        ]);
    }
}
