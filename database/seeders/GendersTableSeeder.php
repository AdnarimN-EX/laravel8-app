<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::insert([
            ['name' => 'MALE'],
            ['name' => 'FEMALE'],
            ['name' => 'LGBT'],
            ['name' => 'UNKNOWN'],
            ['name' => 'NOT APPLICABLE'],
        ]);
    }
}
