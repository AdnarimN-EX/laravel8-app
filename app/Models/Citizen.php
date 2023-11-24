<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Citizen extends Model
{
    /**
     * The default timezone.
     *
     * @var string
     */
    public $timezone = 'Asia/Manila';

    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * List of barangays.
     *
     * @var array
     */
    public static $barangays = [
        "ALASAS",
        "BALITI",
        "BULAON",
        "CALULUT",
        "DELA PAZ NORTE",
        "DELA PAZ SUR",
        "DEL CARMEN",
        "DEL PILAR",
        "DEL ROSARIO",
        "DOLORES",
        "JULIANA",
        "LARA",
        "LOURDES",
        "MAGLIMAN",
        "MAIMPIS",
        "MALINO",
        "MALPITIC",
        "PANDARAS",
        "PANIPUAN",
        "POBLACION",
        "PULUNGBULU",
        "QUEBIAWAN",
        "SAGUIN",
        "SAN AGUSTIN",
        "SAN FELIPE",
        "SAN ISIDRO",
        "SAN JOSE",
        "SAN JUAN",
        "SAN NICOLAS",
        "SAN PEDRO",
        "STA. LUCIA",
        "STA. TERESITA",
        "STO. NIÑO",
        "SINDALAN",
        "TELABASTAGAN",
    ];

    /**
     * List of suffixes.
     *
     * @var array
     */
    public static $suffixes = [
        "SR",
        "JR",
        "I",
        "II",
        "III",
        "IV",
        "V",
        "VI",
        "VII",
        "VIII",
        "IX",
        "X",
        "XI",
        "XII",
        "XIII",
        "XIV",
        "XV",
        "XVI",
        "XVII",
        "XVIII",
        "XIX",
        "XX",
    ];

    /**
     * Calculate the age via Carbon.
     *
     * @return int
     */
    public function age()
    {
        return Carbon::parse($this->birthdate)->setTimezone($this->timezone)->age;
    }

    /**
     * Returns age with text.
     *
     * @return string
     */
    public function ageText()
    {
        $age = $this->age() > 1 ? 'years' : 'year';

        return "{$age} old";
    }

    /**
     * Parses the birthdate.
     *
     * @param string $format
     *
     * @return string
     */
    public function parseBirthdate($format = 'M. d, Y')
    {
        if ($this->birthdate) {
            return Carbon::parse($this->birthdate)->setTimezone($this->timezone)->format($format);
        }
    }

    /**
     * Parses the full name.
     *
     * @return int
     */
    public function fullName($format = '')
    {
        if ('' === $format) {
            $forename = "{$this->forename} ";
            $surname = $this->surname;
            $midname = $this->midname;
            $suffix = $this->suffix;

            $midname = $midname ? "{$midname}" : '';
            $suffix = $suffix ? " {$suffix} " : '';

            return trim("{$surname}, {$forename}{$suffix}{$midname}");
        }

        if ('F S M. L' === $format) {
            $forename = "{$this->forename} ";
            $surname = $this->surname;
            $midname = $this->midname;
            $suffix = $this->suffix;

            $midname = $midname ? substr("{$midname}", 0, 1) . '. ' : '';
            $suffix = $suffix ? " {$suffix} " : '';

            return trim("{$forename}{$suffix}{$midname}{$surname}");
        }
    }

    /**
     * Get the gender of the citizen.
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class)->withDefault([
            'name' => 'N/A',
        ]);
    }

    /**
     * Get the profile of the citizen.
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * Searches a citizen via PIN.
     *
     * @param string $keyword
     * @return App\Models\Citizen
     */
    public function search($keyword)
    {
        return $this->where('pin', $keyword)->firstOrFail();
    }

    public function fetch($perPage = null)
    {
        $perPage = $perPage ?: config('app.resource_per_page');

        return $this->paginate($perPage);
    }

    public function scopeFilterByPin($query, $pin)
    {
        if ($pin) {
            $query->where('pin', $pin);
        }
    }

    public function scopeFilterBySurname($query, $surname)
    {
        if ($surname) {
            $query->where('surname', $surname);
        }
    }

    public function scopeFilterByForename($query, $forename)
    {
        if ($forename) {
            $query->where('forename', 'LIKE', "%$forename%");
        }
    }

    public function scopeFilterBySuffix($query, $suffix)
    {
        if ($suffix) {
            $query->where('suffix', $suffix);
        }
    }

    public function scopeFilterByMidname($query, $midname)
    {
        if ($midname) {
            $query->where('midname', $midname);
        }
    }

    public function scopeFilterByVicinity($query, $vicinity)
    {
        if ($vicinity) {
            $query->where('vicinity', $vicinity);
        }
    }

    public function scopeFilterByBarangay($query, $barangay)
    {
        if ($barangay) {
            $query->where('barangay', $barangay);
        }
    }

    public function scopeFilterByBirthdate($query, $birthdate)
    {
        if ($birthdate) {
            $query->where('birthdate', $birthdate);
        }
    }

    public function scopeFilterByGender($query, $gender)
    {
        if ($gender) {
            $query->where('gender_id', $gender);
        }
    }

    public function scopeFilterBySector($query, $sector)
    {
        if ($sector) {
            $query->whereHas('profile.sectors', function ($query) use ($sector) {
                $query->where('sector_id', $sector);
            });
        }
    }

    public function scopeFilterByCategory($query, $category)
    {
        if ($category) {
            $query->whereHas('profile', function ($query) use ($category) {
                $query->where('kayabe_kard_type_id', $category);
            });
        }
    }

    /**
     * Returns the last pin series by given year.
     *
     * @return int
     */
    public static function getLastPinSeries($pinYear)
    {
        $citizen = new self;

        $lastCitizen = $citizen->where('pin_year', $pinYear)->orderBy('pin_series', 'DESC')->first();

        if ($lastCitizen) {
            return $lastCitizen->pin_series;
        }

        return 0;
    }

    /**
     * Uploads the photo(s).
     *
     * @param \Illuminate\Support\Collection $avatar
     * @param \App\Models\Citizen $citizen
     */
    public static function uploadAvatar($avatar, $citizen)
    {
        $file = $avatar->store(config('app.avatar_upload_path') . '/' . $citizen->id, 'public');

        // Retrieve the file's name.
        $fileSlugs = explode("/", $file);
        $fileNameIndex = count($fileSlugs) - 1;
        $fileName = $fileSlugs[$fileNameIndex];

        // Store file's info in storage.
        $citizen->update(['avatar' => $fileName]);

        return $citizen->refresh();
    }
    
    //
    public function scopeFilterSearch($query, $request)
    {
        if ($request->has('quicksearch')) {
            $query->where(function ($innerQuery) use ($request) {
                $innerQuery->where('surname', 'LIKE', '%' . $request->input('quicksearch') . '%')
                    ->orWhere('forename', 'LIKE', '%' . $request->input('quicksearch') . '%')
                    ->orWhere('midname', 'LIKE', '%' . $request->input('quicksearch') . '%')
                    ->orWhere('barangay', 'LIKE', '%' . $request->input('quicksearch') . '%')
                    ->orWhere('vicinity', 'LIKE', '%' . $request->input('quicksearch') . '%');
            });
        }

        if ($request->filled('gender_id')) {
            $query->where('gender_id', $request->input('gender_id'));
        }

        if ($request->filled('barangay')) {
            $query->where('barangay', $request->input('barangay'));
        }

        if ($request->filled('birthdate')) {
            $query->where('birthdate', 'LIKE', '%' . $request->input('birthdate') . '%');
        }
        return $query->orderBy('id','asc');
    }

    public function getGenderStats()
    {
        $barangay = self::$barangays;
        $genders = Gender::all();

        $genderCounts = $this->select('barangay', 'gender_id', DB::raw('count(*) as count'))
        ->groupBy('barangay', 'gender_id')->get();

        session(['barangays' => $barangay, 'gender' => $genders, 'countGender' => $genderCounts]);

        return $genderCounts;
    }

    public function getSectorStats()
    {
        $barangay = self::$barangays;
        $sector = Sector::all();

        $countSector = $this->join('profiles', 'citizens.profile_id', '=', 'profiles.id')
        ->join('profile_sector', 'profiles.id', '=', 'profile_sector.profile_id')
        ->select('citizens.barangay', 'profile_sector.sector_id', DB::raw('count(*) as count'))
        ->groupBy('citizens.barangay', 'profile_sector.sector_id')->get();

        session(['barangays' => $barangay, 'sector' => $sector, 'countSector' => $countSector]);

        return $countSector;
    }
}
