<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Option;
use App\Models\Person;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Team;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Questionnaire $questionnaire)
    {
        $questionaire_team = $questionnaire->teams()->get();

        $team_people = array();

        foreach($questionaire_team as $row){
            $team = Team::find($row->pivot->team_id);

            array_push($team_people, $team->people()->get());
        }
        
        return view('answers.index', ["team_people" => $team_people]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person, Questionnaire $questionnaire)
    {
        $topics = $questionnaire->topics()->get();
        $answers = $person->answers()->get();

        $questionnaire_estructure = [];
        $answers_estructure = array();

        $result = [];

        foreach ($topics as $topic) {
            $topic_questions = $topic->with('questions')->get();


            foreach ($topic_questions as $topic_question) {
                foreach ($topic_question["questions"] as $question) {
                    $options = Option::where('question_id', '=', $question->id)->get();

                    $question["options"] = $options;

                    $questionnaire_estructure = $topic_questions;
                }
            }
        }

        foreach ($answers as $answer) {
            $option = Option::where('id', '=', $answer->option_id)->get();

            foreach ($option as $op) {
                $question = Question::where('id', '=', $op->question_id)->get();
                
                foreach ($question as $qt) {
                    $answer['question'] = $qt;

                    $topic = Topic::where('id', '=', $qt->topic_id)->get();

                    foreach ($topic as $tp) {
                        $answer['topic'] = $tp;   
                    }
                }
            }
            
            array_push($answers_estructure, $answer);
        }
        
        $result["questionnaire_estructure"] = $questionnaire_estructure;
        $result["answers_estructure"] = $answers_estructure;

        return view('answers.detail', ["data" => $result]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
