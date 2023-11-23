<?php

namespace Database\Seeders;

use App\Models\KayabeKardType;
use Illuminate\Database\Seeder;

class KayabeKardTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KayabeKardType::insert([
            ['name' => 'RED'],
            ['name' => 'BLUE'],
            ['name' => 'WHITE'],
        ]);
    }
}
