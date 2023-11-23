<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sector::insert([
            [
                'code' => 'DIALYSIS',
                'name' => 'DIALYSIS/CHEMO PATIENT',
            ],
            [
                'code' => 'PWD',
                'name' => 'PERSONS WITH DISABILITIES',
            ],
            [
                'code' => 'SC',
                'name' => 'SENIOR CITIZEN',
            ],
            [
                'code' => 'SP',
                'name' => 'SOLO PARENT',
            ],
        ]);
    }
}
