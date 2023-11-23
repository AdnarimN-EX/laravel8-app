<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The profiles that belong to the sector.
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class,'profile_sector', 'sector_id', 'profile_id');
    }
}
