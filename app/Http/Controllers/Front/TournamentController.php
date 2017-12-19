<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TournamentRepository;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    /**
     * @var \App\Repositories\TournamentRepository;
     */
    protected $repository;

    /**
     * The pagination number of tournaments
     * @var int
     */
    protected $nbrPages;

    /**
     * Create an instance of TournamentController
     * @param TournamentRepository $tournamentRepository
     */
    public function __construct(TournamentRepository $tournamentRepository)
    {
        $this->repository = $tournamentRepository;
        $this->nbrPages = config('app.nbrPages.front.tournaments');
    }

    /**
     * Index tournaments page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tournaments = $this->repository->getActiveOrderByDate($this->nbrPages);
        return view(env('THEME').'.front.tournaments.index', compact('tournaments'));
    }

    /**
     * Detailed page of the tournament
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $tournament = $this->repository->getTournamentBySlug($slug);
        $currentParticipant = $tournament->currentParticipant();

        return view(env('THEME').'.front.tournaments.overview', compact('tournament', 'currentParticipant'));
    }

    /**
     * Rules page
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rules($slug)
    {
        $tournament = $this->repository->getTournamentBySlug($slug);
        $currentParticipant = $tournament->currentParticipant();
        return view(env('THEME').'.front.tournaments.rules', compact('tournament', 'currentParticipant'));
    }


    /**
     * Classes page
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View || \Illuminate\Http\Response
     */
    public function classes($slug)
    {
        $tournament = $this->repository->getTournamentBySlug($slug);
        $currentParticipant = $tournament->currentParticipant();

        if(!$currentParticipant) {
            return redirect()->route('tournaments.display', ['slug' => $slug]);
        }
        return view(env('THEME').'.front.tournaments.classes',
            compact('tournament', 'currentParticipant'));
    }

    /**
     * Participants page
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function participants($slug)
    {
        $tournament = $this->repository->getTournamentBySlug($slug);
        $currentParticipant = $tournament->currentParticipant();
        $participants = $tournament->participants()->get();
        return view(
            env('THEME').'.front.tournaments.participants',
            compact(
                'tournament',
                'currentParticipant',
                'participants'
            )
        );
    }

    /**
     * Grid page
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function grid($slug)
    {
        $tournament = $this->repository->getTournamentBySlug($slug);
        $currentParticipant = $tournament->currentParticipant();
        $participants = $tournament->participants()->get();
        return view(
            env('THEME').'.front.tournaments.grid',
            compact(
                'tournament',
                'currentParticipant',
                'participants'
            )
        );
    }


}
