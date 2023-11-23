<?php

namespace Database\Seeders;

use App\Models\LivelihoodStatus;
use Illuminate\Database\Seeder;

class LivelihoodStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LivelihoodStatus::insert([
            ['name' => 'BELOW MINIMUM/NOT SELF-SUFFICIENT'],
            ['name' => 'ALMOST NONE'],
        ]);
    }
}
