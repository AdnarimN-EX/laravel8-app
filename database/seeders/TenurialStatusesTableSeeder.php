<?php

namespace Database\Seeders;

use App\Models\TenurialStatus;
use Illuminate\Database\Seeder;

class TenurialStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TenurialStatus::insert([
            ['name' => 'SHARER'],
            ['name' => 'RENT/RENT-TO-OWN'],
            ['name' => 'INFORMAL SETTLER'],
        ]);
    }
}
