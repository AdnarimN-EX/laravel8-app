<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCondition extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The profiles that belong to the health condition.
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_health_condition');
    }
}
