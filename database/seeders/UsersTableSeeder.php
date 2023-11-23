<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    protected $totalUser = 9;
    protected $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now('Asia/Singapore');
        $password = Hash::make("123456");

        User::create([
            'name' => 'CICTO',
            'email' => 'cicto@cityofsanfernando.gov.ph',
            'password' => $password,
            'role_id' => 1,
            'remember_token' => Str::random(10),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        if (!config('database.seed.fresh')) {
            for ($i = 0; $i < $this->totalUser; $i++) {
                $forename = strtoupper($this->faker->firstName);
                $surname = strtoupper($this->faker->lastName);
                $name = $forename . ' ' . $surname;
                $email = strtolower($forename) . strtolower($surname) . '@gmail.com';

                User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'role_id' => 2,
                    'remember_token' => Str::random(10),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
