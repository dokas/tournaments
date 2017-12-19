<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tournaments\Tournament;
use App\Models\User;

class Participant extends Model
{

    protected $fillable = [
      'tournament_id', 'user_id', 'payed', 'confirmed'
    ];

    /**
     * One to many relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tournament()
    {
        return $this->belongsTo('App\Models\Tournaments\Tournament');
    }

    /**
     * One to many relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Many to many relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hero_classes()
    {
        return $this->belongsToMany('App\Models\Tournaments\HeroClass');
    }

    /**
     * @param $heroClassId
     * @return Model|null|static
     */
    public function hasHeroClass($heroClassId)
    {
        return $this->hero_classes()->where('hero_class_id', $heroClassId)->first();
    }
}
