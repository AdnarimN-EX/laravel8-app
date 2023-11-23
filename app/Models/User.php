<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Returns the resources.
     *
     * @param $queryInstance - The current query builder instance.
     * @param string $keyword - The search term that we want to look for.
     * @return App\Models\User
     */
    public function fetch($queryInstance = null, $keyword = '')
    {
        $User = $queryInstance ?? $this;

        return $User
            ->with('role')
            ->whereHas('role', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%");
            })
            ->orWhere('name', 'LIKE', "%{$keyword}%")
            ->orWhere('email', 'LIKE', "%{$keyword}%")
            ->orderBy('name', 'asc');
    }

    /**
     * Search the resources by keyword.
     *
     * @param $query - The current query builder instance.
     * @param string $keyword - The search term that we want to look for.
     * @return App\Models\User
     */
    public function scopeSearch($query, $keyword)
    {
        return $this->fetch($query, $keyword);
    }

    /**
     * Get the role of the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class)->withDefault([
            'name' => 'N/A',
        ]);
    }

    /**
     * Checks if the user is an administrative user, 
     * E.g. The positions in the roles table.
     * @return boolean
     */
    public function isAdministrative()
    {
        return $this->role_id;
    }

    /**
     * Checks if the user is a standard user, 
     * e.g. A citizen with a user account.
     * @return boolean
     */
    public function isMember()
    {
        return !$this->role_id;
    }
}
