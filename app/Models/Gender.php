<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * List of gender CSS classes.
     *
     * @var array
     */
    public static $cssClasses = [
        'FEMALE' => 'fa-solid fa-venus text-xl text-pink-500',
        'MALE' => 'fa-solid fa-mars text-xl text-blue-500',
        'LGBT' => 'fa-solid fa-transgender text-xl text-purple-500',
        'UNKNOWN' => 'fa-solid fa-question text-xl text-gray-500',
    ];

    /**
     * Get the citizens associated with the gender.
     */
    public function citizens()
    {
        return $this->belongsToMany(Citizen::class);
    }
}
