<?php

namespace Database\Seeders;

use App\Models\FloodExposure;
use Illuminate\Database\Seeder;

class FloodExposuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FloodExposure::insert([
            ['name' => 'FLASH FOOD'],
            ['name' => 'WEEK-LONG FLOODING'],
            ['name' => 'PRONE TO EXPERIENCE DISPLACEMENT'],
        ]);
    }
}
