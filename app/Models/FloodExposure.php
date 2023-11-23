<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloodExposure extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The profiles that belong to the flood exposure.
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_flood_exposure');
    }
}
