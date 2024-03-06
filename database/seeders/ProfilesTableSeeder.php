<?php

namespace Database\Seeders;

use App\Models\FamilyIncomeRange;
use App\Models\FloodExposure;
use App\Models\HealthCondition;
use App\Models\KayabeKardType;
use App\Models\LivelihoodStatus;
use App\Models\Profile;
use App\Models\Sector;
use App\Models\TenurialStatus;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    protected $totalProfile;
    protected $faker;

    public function __construct(Faker $faker)
    {
        $this->totalProfile = 50000;
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
            for ($i = 1; $i <= $this->totalProfile; $i++) {
                $profile = Profile::create([
                    'livelihood_status_id' => $this->livelihood_status_id(),
                    'family_income_range_id' => $this->family_income_range_id(),
                    'tenurial_status_id' => $this->tenurial_status_id(),
                    'kayabe_kard_type_id' => $this->kayabe_kard_type_id(),
                    'family_vulnerability' => $this->faker->boolean(),
                    'total_dependents' => $this->faker->numberBetween($min = 0, $max = 5),
                    'identity_card_no' => $this->faker->creditCardNumber(),
                    'medication' => strtoupper($this->faker->paragraph()),
                    'remarks' => strtoupper($this->faker->paragraph()),
                ]);

                /**
                 * Populate an intermediate table (profie_sector)
                 */

                $totalSectors = Sector::select('id')->get()->count();
                // Generate a random total sectors.
                $randomTotalSectors = $this->faker->numberBetween($min = 1, $max = $totalSectors);

                for ($sectorId = 1; $sectorId <= $randomTotalSectors; $sectorId++) {
                    $profile->sectors()->attach($sectorId);
                }

                /**
                 * Populate an intermediate table (profile_health_condition)
                 */

                $totalHealthConditions = HealthCondition::select('id')->get()->count();
                // Generate a random total health conditions.
                $randomTotalHealthConditions = $this->faker->numberBetween($min = 1, $max = $totalHealthConditions);

                for ($healthConditionId = 1; $healthConditionId <= $randomTotalHealthConditions; $healthConditionId++) {
                    $profile->healthConditions()->attach($healthConditionId);
                }

                /**
                 * Populate an intermediate table (profile_flood_exposures)
                 */

                $totalFloodExposures = FloodExposure::select('id')->get()->count();
                // Generate a random total flood exposures.
                $randomTotalFloodExposures = $this->faker->numberBetween($min = 1, $max = $totalFloodExposures);

                for ($floodExposureId = 1; $floodExposureId <= $randomTotalFloodExposures; $floodExposureId++) {
                    $profile->floodExposures()->attach($floodExposureId);
                }
            }

            // A Sample record with incomplete info. (FOR TESTING PURPOSES)
            Profile::create([
                'livelihood_status_id' => null,
                'family_income_range_id' => null,
                'tenurial_status_id' => null,
                'kayabe_kard_type_id' => null,
                'family_vulnerability' => null,
                'total_dependents' => null,
                'identity_card_no' => null,
                'medication' => null,
                'remarks' => null,
            ]);
        }
    }

    /**
     * Generates random resourse id.
     *
     * @return int - Livelihood Status ID
     */
    public function livelihood_status_id()
    {
        $ids = LivelihoodStatus::select('id')->get()->pluck('id');

        return $this->faker->randomElement($array = $ids);
    }

    /**
     * Generates random resourse id.
     *
     * @return int - Family Income Range ID
     */
    public function family_income_range_id()
    {
        $ids = FamilyIncomeRange::select('id')->get()->pluck('id');

        return $this->faker->randomElement($array = $ids);
    }

    /**
     * Generates random resourse id.
     *
     * @return int - Tenurial Status ID
     */
    public function tenurial_status_id()
    {
        $ids = TenurialStatus::select('id')->get()->pluck('id');

        return $this->faker->randomElement($array = $ids);
    }

    /**
     * Generates random resourse id.
     *
     * @return int - Kayabe Kard Type ID
     */
    public function kayabe_kard_type_id()
    {
        $ids = KayabeKardType::select('id')->get()->pluck('id');

        return $this->faker->randomElement($array = $ids);
    }
}
