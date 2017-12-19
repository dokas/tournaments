<?php

namespace App\Models\Tournaments;

use App\Models\IngoingTrait;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class Tournament extends Model
{
    use IngoingTrait;

    /**
     * The events map for the model
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = [
        "title", "slug", "start_time", "participants_amount", "fee", "prize", "description", "img", "active", "user_id"
    ];

    /**
     * One to many relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * One many relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    /**
     * Check if tournament has started
     * @return bool
     */
    public function isStarted()
    {
        if ($this->start_time - time() > 0) {
            return false;
        }
        return true;
    }

    /**
     * Participant of authenticated user
     * @return Participant|null
     */
    public function currentParticipant()
    {
        if(Auth::check()) {
            return $this->participants()->where('user_id', auth()->user()->id)->first();
        }
        return null;
    }

    /**
     * Relationship many to many
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function games()
    {
        return $this->belongsToMany('App\Models\Tournaments\Game');
    }

    /**
     * Tournament game
     * @return Game
     */
    public function getGame()
    {
        return $this->games()->first();
    }

    /**
     * Relationship one to many
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function heroClasses()
    {
        return $this->getGame()->heroClasses();
    }
}
