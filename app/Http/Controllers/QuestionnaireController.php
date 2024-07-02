<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\Team;

class QuestionnaireController extends Controller
{
    public function view(Questionnaire $questionnaire)
    {
        return view('questionnaire.view')
            ->with('questionnaire', $questionnaire);
    }

    public function create()
    {
        $teams = Team::all();

        return view('questionnaire.create')
            ->with('teams', $teams);
    }

    public function save(Request $request)
    {
        $questionnaire = new Questionnaire();
        $questionnaire->name        = $request->input('name');
        $questionnaire->description = $request->input('description');
        $questionnaire->roulette    = $request->input('roulette') == 'on';
        $questionnaire->random      = $request->input('presentation') == 'random';        
        $questionnaire->save();

        $questionnaire->teams()->attach($request->teams);
        
        return redirect()->route('questionnaire.edit', $questionnaire)
            ->with('success', 'Questionnaire saved!');
    }

    public function edit(Questionnaire $questionnaire)
    {
        $teams = Team::all();
        $questionnaire_teams = $questionnaire->teams()->get();
        $teams_avaibles = array();

        foreach ($teams as $team) {
            $isInTeam = false;

            foreach ($questionnaire_teams as $questionnaire_team) {
                if ($questionnaire_team->id == $team->id) {
                    $isInTeam = true;
                    break;
                }
            }

            if ($isInTeam == false) {
                array_push($teams_avaibles, $team);
            }
        }

        return view('questionnaire.edit')
            ->with('questionnaire', $questionnaire)
            ->with('teams_avaibles', $teams_avaibles)
            ->with('questionnaire_teams', $questionnaire_teams);

    }

    public function update(Request $request, Questionnaire $questionnaire)
    {
        $questionnaire->name        = $request->input('name');
        $questionnaire->description = $request->input('description');
        $questionnaire->roulette    = $request->input('roulette') == 'on';
        $questionnaire->random      = $request->input('presentation') == 'random';
        $questionnaire->save();

        if($request->input('topic') !== null){
            $topic = new Topic();
            $topic->questionnaire()->associate($questionnaire);
            $topic->name = $request->input('topic');
            $topic->save();
        }

        if($request->input('team') !== null) {
            $team = Team::where('id', $request->input('team'))->firstOrFail();
            $team->questionnaires()->attach($questionnaire);
        }

        return redirect()->route('questionnaire.edit', $questionnaire);
    }

    // Método para deletar um questionário
    public function delete(Questionnaire $questionnaire)
    {
        $questionnaire->delete();
        return redirect()->route('home');
    } 
}
