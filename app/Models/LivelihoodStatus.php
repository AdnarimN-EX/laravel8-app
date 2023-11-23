<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivelihoodStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Get the profiles associated with the livelihood status.
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
