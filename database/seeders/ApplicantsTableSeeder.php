<?php

namespace Database\Seeders;

use App\Helpers\Utility;
use App\Models\Applicant;
use App\Models\Citizen;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ApplicantsTableSeeder extends Seeder
{
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
        if (!config('database.seed.fresh')) {
            for ($i = 0; $i < 100; $i++) {
                $gender = $this->faker->randomElement($array = array('male', 'female'));
                $forename = $this->faker->firstName($gender);
                $midname = $this->faker->randomElement($array = array(null, $this->faker->lastName));
                $surname = $this->faker->lastName;
                $suffix = $this->suffix($this->faker, Citizen::$suffixes, $gender, $midname);
                $birthdate = $this->faker->dateTimeBetween($startDate = '1970-01-01 00:00:00', $endDate = '2003-12-31 23:59:59', $timezone = null)->format('Y-m-d');
                $gender_id = $gender == 'male' ? 1 : 2;
                $vicinity = $this->address($this->faker);
                $barangay = $this->faker->randomElement($array = Citizen::$barangays);
                $mobile_no = '0' . $this->faker->numberBetween($min = 9000000000, $max = 9999999999);
                $created_at = $this->faker->dateTimeBetween($startDate = date('Y') . '-01-01 00:00:00', $endDate = date('Y-m-d H:i:s'), $timezone = null)->format('Y-m-d H:i:s');

                Applicant::create([
                    'forename_aes' => $forename,
                    'midname_aes' => $midname,
                    'surname_aes' => $surname,
                    'suffix_aes' => $suffix,
                    'birthdate' => $birthdate,
                    'gender_id' => $gender_id,
                    'vicinity' => $vicinity,
                    'barangay' => $barangay,
                    'mobile_no_aes' => $mobile_no,
                    'created_at' => $created_at,
                ]);
            }

            Applicant::create([
                'forename_aes' => '',
                'midname_aes' => '',
                'surname_aes' => '',
                'suffix_aes' => '',
                'birthdate' => null,
                'gender_id' => null,
                'vicinity' => '',
                'barangay' => '',
                'mobile_no_aes' => '',
                'created_at' => null,
            ]);
        }
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
