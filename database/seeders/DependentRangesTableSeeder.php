<?php

namespace Database\Seeders;

use App\Models\DependentRange;
use Illuminate\Database\Seeder;

class DependentRangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DependentRange::insert([
            ['name' => 'TWO OR THREE'],
            ['name' => 'MORE THAN 3'],
        ]);
    }
}
