<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * Get administrator
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAdministrator()
    {
        return $this->where('name','administrator')->first();
    }

    /**
     * Get author
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAuthor()
    {
        return $this->where('name','author')->first();
    }

    /**
     * Get player
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPlayer()
    {
        return $this->where('name','player')->first();
    }
}
