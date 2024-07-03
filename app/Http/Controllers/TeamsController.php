<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostTeamRequest;
use App\Models\Person;
use App\Models\Questionnaire;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();


        foreach ($teams as $team) {
            $team['people_count'] = $team->people()->count();
            $team['questionnaires'] = $team->questionnaires()->get();
        }

        return view('teams.index', ['data' => $teams]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostTeamRequest $request)
    {
        $validated = $request->validated();

        $newTeam = new Team();
        $newTeam->name = $validated['team_name'];
        
        $newTeam->save();

        return redirect()->route('teams.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $people_team = $team->people()->get();
        $people = Person::all();

        foreach ($people_team as $person_team) {
            $person_team = $person_team->user->get();
        }

        foreach ($people as $person) {
            $person = $person->user->get();
        }

        $people_avaibles = array();

        foreach ($people as $person) {
            $isInTeam = false;

            foreach ($people_team as $person_team) {
                if ($person_team->id == $person->id) {
                    $isInTeam = true;
                    break;
                }
            }

            if (!$isInTeam) {
                array_push($people_avaibles, $person);
            }
        }

        $result = array();

        $result['people_team'] = $people_team;
        $result['people_avaibles'] = $people_avaibles;
        $result['team'] = $team;

        return view('teams.edit', ['data' => $result]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Team $team, Request $request)
    {

        $people = Person::whereIn('id', $request->input('person_id'))->get();
 
        $team->people()->attach($people);

        return redirect()->route('teams.edit', $team->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_person(Team $team, Request $request)
    {
        $person = Person::where('id', $request->input('person_team_id'))->get();
     
        $team->people()->detach($person);

        return redirect()->route('teams.edit', $team->id);
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index');
    }

    public function detach_questionnaire(Team $team, Questionnaire $questionnaire)
    {
        $team->questionnaires()->detach($questionnaire);

        return redirect()->back();
    } 
}
