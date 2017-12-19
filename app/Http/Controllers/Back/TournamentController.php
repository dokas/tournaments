<?php

namespace App\Http\Controllers\Back;

use App\Models\Tournaments\Game;
use App\Repositories\TournamentRepository;
use App\Http\Controllers\Controller;
use App\Models\Tournaments\Tournament;
use App\Models\Role;
use App\Http\Requests\TournamentUpdateRequest;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{

    use Indexable;

    /**
     * Create a new TournamentController instance
     * @param TournamentRepository $tournamentRepository
     */
    public function __construct(TournamentRepository $tournamentRepository) {
        $this->repository = $tournamentRepository;

        $this->table = 'tournaments';
    }

    /**
     * Update "new" field for tournament.
     *
     * @param  \App\Models\Tournaments\Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(Tournament $tournament)
    {
        $tournament->ingoing->delete ();

        return response ()->json ();
    }

    /**
     * Update "active" field for tournament.
     *
     * @param  \App\Models\Tournaments\Tournament $tournament
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Tournament $tournament, $status = false)
    {
        $tournament->active = $status;
        $tournament->save();

        return response ()->json ();
    }

    /**
     * Show the form for creating a new tournament.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(env('THEME').'.back.tournaments.create');
    }

    /**
     * Store a newly created tournament in storage.
     *
     * @param  \App\Http\Requests\TournamentUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TournamentUpdateRequest $request)
    {
        $this->repository->store($request);

        return redirect(route('tournaments.index'))->with('tournament-ok', __('The tournament has been successfully created'));
    }

    /**
     * Display the tournament.
     *
     * @param  \App\Models\Tournaments\Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
        return view(env('THEME').'.back.tournaments.show', compact('tournament'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Tournaments\Tournament $tournament
     * @param  \App\Models\Tournaments\Game $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament, Game $game)
    {
        $games = $game->all()->pluck('name', 'id');
        return view(env('THEME').'.back.tournaments.edit', compact('tournament', 'games'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TournamentUpdateRequest $request
     * @param  \App\Models\Tournaments\Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(TournamentUpdateRequest $request, Tournament $tournament)
    {
        $this->repository->update($request, $tournament);

        return back()->with('tournament-updated', __('The tournament has been successfully updated'));
    }

    /**
     * Remove the tournament from storage.
     *
     * @param  \App\Models\Tournaments\Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        $tournament->delete ();

        return response ()->json ();
    }
}
