<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MakesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('makes')->insert([
            ['name' => 'Audi'],
            ['name' => 'Toyota'],
            ['name' => 'Honda'],
            ['name' => 'Mercedes']
        ]);
    }
}
