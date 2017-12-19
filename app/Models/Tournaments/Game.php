<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * Relationship many to many
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tournaments()
    {
        return $this->belongsToMany('App\Models\Tournaments\Tournament');
    }

    /**
     * Relationship one to many
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function heroClasses()
    {
        return $this->hasMany('App\Models\Tournaments\HeroClass');
    }
}
