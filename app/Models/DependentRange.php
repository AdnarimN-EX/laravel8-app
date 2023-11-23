<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DependentRange extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Get the profiles associated with the family income range.
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
