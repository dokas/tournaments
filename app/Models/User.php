<?php

namespace App\Models;

use App\Models\Tournaments\Participant;
use App\Models\Tournaments\Tournament;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\IngoingTrait;
use App\Events\ModelCreated;

class User extends Authenticatable
{
    use Notifiable, IngoingTrait;

    /**
     * The event map for the model
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'name', 'surname', 'date_of_birth', 'sex', 'country', 'about', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relationship one to meny
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    /**
     * Get user role
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getRole()
    {
        return $this->roles()->first();
    }

    /**
     * Check role presence
     * @param $name
     * @return true|false
     */
    public function hasRole($name)
    {
        return $this->roles()->where('name', $name)->count() ? true : false;
    }

    /**
     * Relationship one to many
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tournaments()
    {
        return $this->hasMany(Tournament::class);
    }

    /**
     * Relationship one to many
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

}
