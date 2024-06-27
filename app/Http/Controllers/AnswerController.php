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
        $questionnaire_topics = $questionnaire->topics()->get();

        $result = null;
        $result['teams'] = array();

        $result['questionnaire'] = $questionnaire;

        foreach ($questionaire_team as $team) {

            $team['people'] = $team->people()->get();

            foreach ($team->people as $person) {
                $person_answers = $person->answers()->get();

                $person['answers_count'] = 0;

                foreach ($questionnaire_topics as $topic) {
                    $topic_questions = $topic->questions()->get();
        
                    foreach ($topic_questions as $topic_question) {
                        $question_options = $topic_question->options()->get();

                        foreach ($question_options as $option) {
                            foreach ($person_answers as $person_answer) {
                                if ($option->id == $person_answer->option_id) {
                                    $person['answers_count'] += 1;
                                }
                            }
                        }
                    }
                }
            }

            array_push($result['teams'], $team);
        }

        return view('answers.index', ["data" => $result]);
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
       $person_answers = $person->answers()->get();

       $result['estructure_questionnaire'] = array();
       $result['person'] = $person;
       $result['questionnaire'] = $questionnaire;

        foreach ($topics as $topic) {
            $questions = $topic->questions()->get();

            $topic['questions'] = $questions;
            
            foreach ($questions as $question) {
                $options = $question->options()->get();
                
                $question['options'] = $options;
                
                foreach ($options as $option) {
                    $options_answers = $option->answers()->get();

                    foreach ($options_answers as $option_answer) {
                        foreach ($person_answers as $person_answer) {
                            if(($option_answer->person_id == $person->id) && ($option_answer->option_id == $person_answer->option_id)) {
                                $option['person_answer'] = true;
                            }
                        }
                    }
                }
            }
        }

        $result['estructure_questionnaire'] = $topics;

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
