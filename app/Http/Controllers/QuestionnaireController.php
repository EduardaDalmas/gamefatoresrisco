<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questionnaire;

class QuestionnaireController extends Controller
{
    public function index() {
        return view('questionnaire.index');
    }

    public function view(Questionnaire $questionnaire) {
        return redirect()->route('topic.index', ['questionnaire' => $questionnaire]);
    }

    public function save(Request $request, Questionnaire $questionnaire) {
        // Save the answer
        // Get the next question
        // return redirect()->route('question.index', ['question' => $question->nextQuestionID]);
    }
}
