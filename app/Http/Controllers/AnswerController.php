<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answerByQuestionnaireAndPerson = DB::table('questionnaires')
            ->join('topics', 'questionnaires.id', '=', 'topics.questionnaire_id')
            ->join('questions', 'topics.id', '=', 'questions.topic_id')
            ->join('options', 'questions.id', '=', 'options.question_id')
            ->join('answers', 'options.id', '=', 'answers.option_id')
            ->join('people', 'answers.person_id', '=', 'people.id')
            ->select('questionnaires.id as questionnaires_id', 'questionnaires.name as questionnaires_name', 'people.name as people_name')
            ->get();

        return view('answers.index')->with('answerByQuestionnaireAndPerson', $answerByQuestionnaireAndPerson);
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
    public function show(string $idQuestionaire)
    {
        $result = DB::table('questionnaires')
            ->where('id', '=', $idQuestionaire)
            ->get();
        
        return $result;
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
