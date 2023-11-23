<?php

namespace Database\Seeders;

use App\Helpers\Utility;
use App\Models\Citizen;
use App\Models\Gender;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CitizensTableSeeder extends Seeder
{
    protected $totalCitizen;
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
        $this->totalCitizen = 100;
        $now = Carbon::now('Asia/Singapore');

        if (!config('database.seed.fresh')) {
            for ($i = 1; $i < $this->totalCitizen; $i++) {
                $gender = $this->faker->randomElement($array = array('male', 'female'));
                $forename = strtoupper($this->faker->firstName($gender));
                $midname = $this->faker->randomElement($array = array(null, strtoupper($this->faker->lastName)));
                $surname = strtoupper($this->faker->lastName);
                $suffix = $this->suffix($this->faker, Citizen::$suffixes, $gender, $midname);
                $birthdate = $this->faker->dateTimeBetween($startDate = '1910-01-01 00:00:00', $endDate = '2003-12-31 23:59:59', $timezone = null)->format('Y-m-d');
                $gender_id = $gender == 'male' ? 1 : 2;
                $vicinity = strtoupper($this->address($this->faker));
                $barangay = strtoupper($this->faker->randomElement($array = Citizen::$barangays));
                $mobile_no = '0' . $this->faker->numberBetween($min = 9000000000, $max = 9999999999);

                Citizen::create([
                    'pin' => $this->pin($i),
                    'pin_year' => date("Y"),
                    'pin_series' => $i,
                    'forename' => $forename,
                    'midname' => $midname,
                    'surname' => $surname,
                    'suffix' => $suffix,
                    'birthdate' => $birthdate,
                    'gender_id' => $gender_id,
                    'vicinity' => $vicinity,
                    'barangay' => $barangay,
                    'profile_id' => $i,
                    'info_status' => 'COMPLETE',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            // A Sample record with incomplete info. (FOR TESTING PURPOSES)
            Citizen::create([
                'pin' => $this->pin($this->totalCitizen + 1),
                'pin_year' => date("Y"),
                'pin_series' => $this->totalCitizen + 1,
                'forename' => null,
                'midname' => null,
                'surname' => null,
                'suffix' => null,
                'birthdate' => null,
                'gender_id' => null,
                'vicinity' => null,
                'barangay' => null,
                'profile_id' => $i,
                'info_status' => 'INCOMPLETE',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    /**
     * Generates a PIN.
     *
     * @param int $series - Profile ID
     * @return string - (e.g. 2023-99999)
     */
    public function pin($series)
    {
        return date("Y") . '-' . $series;
    }
     /**
     * Returns the address/vicinity that will be used in the seeder.
     *
     * @param object Faker\Generator as Faker
     * @return string Address | Vicinity
     */
    public  function address($faker)
    {
        $address = explode(',', $faker->address);
        $address = explode(' ', $address[0]);
        $address = "{$address[0]} {$address[1]}";

        return $address;
    }

    /**
     * Returns the suffix name that will be used in the seeder.
     *
     * @param object Faker\Generator as Faker
     * @param string $gender - e.g. male, female
     * @param array $suffixes
     * @param string $midname
     * @return string Suffix Name
     */
    public  function suffix($faker, $suffixes, $gender, $midname)
    {
        if ('male' == $gender && $midname) {
            return $faker->randomElement($array = $suffixes);
        }
    }
}
