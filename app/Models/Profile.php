<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the citizen that owns the profile.
     */
    public function citizen()
    {
        return $this->hasOne(Citizen::class);
    }

    /**
     * Get the dependent range of the profile.
     */
    public function dependentRange()
    {
        return $this->belongsTo(DependentRange::class)->withDefault([
            'name' => 'N/A',
        ]);
    }

    /**
     * Get the family income range of the profile.
     */
    public function familyIncomeRange()
    {
        return $this->belongsTo(FamilyIncomeRange::class)->withDefault([
            'name' => 'N/A',
        ]);
    }

    /**
     * The flood exposures that belong to the profile.
     */
    public function floodExposures()
    {
        return $this->belongsToMany(FloodExposure::class, 'profile_flood_exposure');
    }

    /**
     * The health conditions that belong to the profile.
     */
    public function healthConditions()
    {
        return $this->belongsToMany(HealthCondition::class, 'profile_health_condition');
    }

    /**
     * Get the kayabe kard type of the profile.
     */
    public function kayabeKardType()
    {
        return $this->belongsTo(KayabeKardType::class)->withDefault([
            'name' => 'N/A',
        ]);
    }

    /**
     * Get the livelihood status of the profile.
     */
    public function livelihoodStatus()
    {
        return $this->belongsTo(LivelihoodStatus::class)->withDefault([
            'name' => 'N/A',
        ]);
    }

    /**
     * The sectors that belong to the profile.
     */
    public function sectors()
    {
        return $this->belongsToMany(Sector::class);
    }

    /**
     * Get the tenurial status of the profile.
     */
    public function tenurialStatus()
    {
        return $this->belongsTo(TenurialStatus::class)->withDefault([
            'name' => 'N/A',
        ]);
    }
}
