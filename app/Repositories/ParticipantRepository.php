<?php

namespace App\Repositories;

use App\Models\Tournaments\Participant;
use App\Models\Tournaments\Tournament;
use App\Models\User;


class ParticipantRepository
{

    /**
     * The model instance
     * @var \App\Models\Tournaments\Participant
     */
    protected $model;

    /**
     * Create a ParticipantRepository instance
     * @param Participant $participant
     */
    public function __construct(Participant $participant)
    {
        $this->model = $participant;
    }

    /**
     * Get users collection paginate.
     *
     * @param  int  $nbrPages
     * @param  array  $parameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($nbrPages, $parameters)
    {
        return $this->model->with (['ingoing'])
            ->orderBy ($parameters['order'], $parameters['direction'])
            ->when ($parameters['new'], function ($query) {
                $query->has ('ingoing');
            })
            ->when($parameters['active'], function ($query) {
                $query->whereActive(true);
            })->paginate ($nbrPages);
    }

    /**
     * @param Tournament $tournament
     * @param User $user
     * @return Participant
     */
    public function getParticipantByTournamentAndUser(Tournament $tournament, User $user)
    {
        return $this->model
            ->whereHas('tournament', function($query) use($tournament) {
                $query->where('id', $tournament->id);
            })
            ->whereHas('user', function($query) use($user) {
                $query->where('id', $user->id);
            })->first();
    }

}

