<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Questionnaire;


class QuestionnaireController extends Controller
{
    public function view(Questionnaire $questionnaire)
    {
        return view('questionnaire.view')
            ->with('questionnaire', $questionnaire);
    }

    public function create()
    {
        return view('questionnaire.create');
    }

    public function save(Request $request)
    {
        $questionnaire = new Questionnaire();
        $questionnaire->name        = $request->input('name');
        $questionnaire->description = $request->input('description');
        $questionnaire->roulette    = $request->input('roulette') == 'on';
        $questionnaire->random      = $request->input('presentation') == 'random';
        $questionnaire->save();
        return redirect()->route('questionnaire.edit', $questionnaire)
            ->with('success', 'Questionnaire saved!');
    }

    public function edit(Questionnaire $questionnaire)
    {
        return view('questionnaire.edit')
            ->with('questionnaire', $questionnaire);
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

        return redirect()->route('questionnaire.edit', $questionnaire);
    }

    // Método para deletar um questionário
    public function delete(Questionnaire $questionnaire)
    {
        $questionnaire->delete();
        return redirect()->route('home');
    }
}
