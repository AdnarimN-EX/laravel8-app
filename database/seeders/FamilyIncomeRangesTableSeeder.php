<?php

namespace Database\Seeders;

use App\Models\FamilyIncomeRange;
use Illuminate\Database\Seeder;

class FamilyIncomeRangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FamilyIncomeRange::insert([
            ['name' => 'ABOVE PT BUT LESS THAN 25K'],
            ['name' => 'BELOW PT (14,498)'],
        ]);
    }
}
