<?php

namespace App\Http\Controllers\Front;

use App\Models\Tournaments\Participant;
use App\Models\Tournaments\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ParticipantRepository;

class ParticipantController extends Controller
{
    /**
     * @var \App\Models\Tournaments\Participant
     */
    protected $model;

    /**
     * @var \App\Repositories\ParticipantRepository
     */
    protected $participantRepository;

    /**
     * Create an instance of ParticipantController
     * @param Participant $model
     * @param ParticipantRepository $participantRepository
     */
    public function __construct(Participant $model, ParticipantRepository $participantRepository)
    {
        $this->model = $model;
        $this->participantRepository = $participantRepository;
    }

    /**
     * Store participant if does not exist
     * @param Request $request
     * @param Tournament $tournament
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Tournament $tournament)
    {
        $participant = $this->participantRepository->getParticipantByTournamentAndUser($tournament, $request->user());
        if(!$participant) {
            $this->model->create([
                'tournament_id' => $tournament->id,
                'user_id' => $request->user()->id,
            ]);
        }

        return back();
    }

    /**
     * Remove participant
     * @param Tournament $tournament
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm(Tournament $tournament)
    {
        $participant = $tournament->currentParticipant();
        $participant->confirmed = 1;
        $participant->save();
        return back();
    }

    /**
     * Remove participant
     * @param Tournament $tournament
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Tournament $tournament)
    {
        if($participant = $tournament->currentParticipant()) {
            $participant->delete();
        }
        return back();
    }

    /**
     * Add or remove hero class for participant
     * @param Participant $participant
     * @param int $heroClassId
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleHeroClass(Participant $participant, $heroClassId)
    {
        $response = true;
        if($participant->hasHeroClass($heroClassId)) {
            $participant->hero_classes()->detach($heroClassId);
        } else {
            if(count($participant->hero_classes()->get()) < config('settings.hero_classes_max')) {
                $participant->hero_classes()->attach($heroClassId);
            } else {
                $response = false;
            }
        }

        return response()->json(['status' => $response]);
    }
}
