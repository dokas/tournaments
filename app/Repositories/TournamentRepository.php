<?php

namespace App\Repositories;

use App\Models\Tournaments\Tournament;
use App\Http\Requests\TournamentUpdateRequest;

class TournamentRepository
{

    /**
     * The model instance
     * @var \App\Models\Tournaments\Tournament
     */
    protected $model;

    /**
     * Create a TournamentRepository instance
     * @param Tournament $tournament
     */
    public function __construct(Tournament $tournament)
    {
        $this->model = $tournament;
    }

    /**
     * Create a query for list of tournaments
     * @return \Illuminate\Database\Query\Builder
     */
    public function queryActiveOrderByDate()
    {
        return $this->model
            ->select('id', 'title', 'slug', 'start_time', 'participants_amount', 'fee', 'prize')
            ->whereActive(true)
            ->latest();
    }

    /**
     * Get active tournaments collection paginated
     * @param $nbrPages
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDate($nbrPages)
    {
        return $this->queryActiveOrderByDate()->paginate($nbrPages);
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
     * Update a tournament.
     *
     * @param  \App\Http\Requests\TournamentUpdateRequest $request
     * @return void
     */
    public function store(TournamentUpdateRequest $request)
    {
        $request->merge(['user_id' => auth()->id()]);
        $request->merge(['active' => $request->has('active')]);
        $request->merge(['start_time' => strtotime($request->get('start_time'))]);

        $tournament = Tournament::create($request->all());

        $tournament->games()->sync($request->game);
    }

    /**
     * Update a tournament.
     *
     * @param  \App\Http\Requests\TournamentUpdateRequest $request
     * @param  \App\Models\Tournaments\Tournament $tournament
     * @return void
     */
    public function update($request, Tournament $tournament)
    {
        $request->merge(['active' => $request->has('active')]);
        $request->merge(['start_time' => strtotime($request->get('start_time'))]);

        $tournament->update($request->all());

        $tournament->games()->sync($request->game);

    }

    /**
     * Get a tournament by slug
     * @param string $slug
     * @return \App\Models\Tournaments\Tournament
     */
    public function getTournamentBySlug($slug)
    {
        $tournament = $this->model->whereSlug($slug)->first();
        return $tournament;
    }

}

