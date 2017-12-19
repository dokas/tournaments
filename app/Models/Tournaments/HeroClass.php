<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;

class HeroClass extends Model
{
    /**
     * Relationship belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo('App\Models\Tournaments\Game');
    }
}
