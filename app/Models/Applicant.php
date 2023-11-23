<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class Applicant extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Names of the encrypted fields after decryption.
     *
     * @var array
     */
    protected $decryptedFieldNames = [
        'forename',
        'midname',
        'surname',
        'suffix',
        'mobile_no',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'forename_aes',
        'midname_aes',
        'surname_aes',
        'suffix_aes',
        'mobile_no_aes',
    ];

    /**
     * Returns the resources.
     *
     * @param $queryInstance - The current query builder instance.
     * @param string $keyword - The search term that we want to look for.
     * @return App\Models\Applicant
     */
    public function fetch($queryInstance = null, $keyword = '')
    {
        $Applicant = $queryInstance ?? $this;

        /**
         * Replacing the single quote with double single quotes
         * will escape the single quote in the SQL command
         * which helps avoid errors during execution.
         */
        $keyword = str_replace("'", "''", strtoupper($keyword));

        return $Applicant
            ->with(['gender'])
            ->selectRaw("*, {$this->sqlEncryptedFields()}")
            ->whereRaw("UPPER(AES_DECRYPT(forename_aes, '" . config('app.key') . "')) LIKE UPPER('%" . $keyword . "%')")
            ->orWhereRaw("UPPER(AES_DECRYPT(midname_aes, '" . config('app.key') . "')) LIKE UPPER('%" . $keyword . "%')")
            ->orWhereRaw("UPPER(AES_DECRYPT(surname_aes, '" . config('app.key') . "')) LIKE UPPER('%" . $keyword . "%')")
            ->orWhereRaw("UPPER(AES_DECRYPT(suffix_aes, '" . config('app.key') . "')) LIKE UPPER('%" . $keyword . "%')")
            ->orWhereRaw("UPPER(AES_DECRYPT(mobile_no_aes, '" . config('app.key') . "')) LIKE UPPER('%" . $keyword . "%')")
            ->oldest();
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
     * Search the resources by keyword.
     *
     * @param $query - The current query builder instance.
     * @param string $keyword - The search term that we want to look for.
     * @return App\Models\Applicant
     */
    public function scopeSearch($query, $keyword)
    {
        return $this->fetch($query, $keyword);
    }

    /**
     * Set the applicant's barangay.
     *
     * @param string $value
     * @return void
     */
    public function setBarangayAttribute($value)
    {
        $this->attributes['barangay'] = strtoupper($value);
    }

    /**
     * Set the applicant's first name.
     *
     * @param string $value
     * @return void
     */
    public function setForenameAesAttribute($value)
    {
        /**
         * Replacing the single quote with double single quotes
         * will escape the single quote in the SQL command
         * which helps avoid errors during execution.
         */
        $forename = str_replace("'", "''", strtoupper($value));

        // Automatically encrypt the value before setting it in the database.
        $this->attributes['forename_aes'] = DB::raw("AES_ENCRYPT('{$forename}', '" . config('app.key') . "')");
    }

    /**
     * Set the applicant's middle name.
     *
     * @param string $value
     * @return void
     */
    public function setMidnameAesAttribute($value)
    {
        /**
         * Replacing the single quote with double single quotes
         * will escape the single quote in the SQL command
         * which helps avoid errors during execution.
         */
        $midname = str_replace("'", "''", strtoupper($value));

        // Automatically encrypt the value before setting it in the database.
        $this->attributes['midname_aes'] = DB::raw("AES_ENCRYPT('{$midname}', '" . config('app.key') . "')");
    }

    /**
     * Set the applicant's mobile number.
     *
     * @param string $value
     * @return void
     */
    public function setMobileNoAesAttribute($value)
    {
        // Automatically encrypt the value before setting it in the database.
        $this->attributes['mobile_no_aes'] = DB::raw("AES_ENCRYPT('{$value}', '" . config('app.key') . "')");
    }

    /**
     * Set the applicant's suffix name.
     *
     * @param string $value
     * @return void
     */
    public function setSuffixAesAttribute($value)
    {
        /**
         * Replacing the single quote with double single quotes
         * will escape the single quote in the SQL command
         * which helps avoid errors during execution.
         */
        $suffix = str_replace("'", "''", strtoupper($value));

        // Automatically encrypt the value before setting it in the database.
        $this->attributes['suffix_aes'] = DB::raw("AES_ENCRYPT('{$suffix}', '" . config('app.key') . "')");
    }

    /**
     * Set the applicant's last name.
     *
     * @param string $value
     * @return void
     */
    public function setSurnameAesAttribute($value)
    {
        /**
         * Replacing the single quote with double single quotes
         * will escape the single quote in the SQL command
         * which helps avoid errors during execution.
         */
        $surname = str_replace("'", "''", strtoupper($value));

        // Automatically encrypt the value before setting it in the database.
        $this->attributes['surname_aes'] = DB::raw("AES_ENCRYPT('{$surname}', '" . config('app.key') . "')");
    }

    /**
     * Set the applicant's vicinity.
     *
     * @param string $value
     * @return void
     */
    public function setVicinityAttribute($value)
    {
        $this->attributes['vicinity'] = strtoupper($value);
    }

    /**
     * Generates a query string for the encrypted fields.
     *
     * @param boolean $withTrailingComma
     * @return string
     */
    public function sqlEncryptedFields($withTrailingComma = false)
    {
        $sql = "";

        foreach ($this->decryptedFieldNames as $field) {
            $sql .= "(AES_DECRYPT({$field}_aes,'" . config('app.key') . "')) AS {$field},";
        }

        // Retain the comma at the end of the string or remove it.
        return $withTrailingComma ? $sql : rtrim($sql, ',');
    }

    public function getForenameAesAttribute($value)
    {
        /**
         * We must empty the field's AES value (gibberish format),
         * to prevent rendering errors when viewing it as JSON.
         */
        return "";
    }

    public function getMidnameAesAttribute($value)
    {
        /**
         * We must empty the field's AES value (gibberish format),
         * to prevent rendering errors when viewing it as JSON.
         */
        return "";
    }

    public function getSurnameAesAttribute($value)
    {
        /**
         * We must empty the field's AES value (gibberish format),
         * to prevent rendering errors when viewing it as JSON.
         */
        return "";
    }

    public function getSuffixAesAttribute($value)
    {
        /**
         * We must empty the field's AES value (gibberish format),
         * to prevent rendering errors when viewing it as JSON.
         */
        return "";
    }

    public function getMobileNoAesAttribute($value)
    {
        /**
         * We must empty the field's AES value (gibberish format),
         * to prevent rendering errors when viewing it as JSON.
         */
        return "";
    }
}
