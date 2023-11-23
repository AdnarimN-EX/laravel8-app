<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(GendersTableSeeder::class);
        $this->call(LivelihoodStatusesTableSeeder::class);
        $this->call(FamilyIncomeRangesTableSeeder::class);
        $this->call(TenurialStatusesTableSeeder::class);
        $this->call(KayabeKardTypesTableSeeder::class);
        $this->call(HealthConditionsTableSeeder::class);
        $this->call(DependentRangesTableSeeder::class);
        $this->call(FloodExposuresTableSeeder::class);
        $this->call(SectorsTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(CitizensTableSeeder::class);
        $this->call(ApplicantsTableSeeder::class);
    }
}
