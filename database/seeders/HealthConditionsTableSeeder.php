<?php

namespace Database\Seeders;

use App\Models\HealthCondition;
use Illuminate\Database\Seeder;

class HealthConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HealthCondition::insert([
            ['name' => 'WITH ILLNESS NEEDS REGULAR MEDICATION'],
            ['name' => 'BEDRIDDEN'],
        ]);
    }
}
