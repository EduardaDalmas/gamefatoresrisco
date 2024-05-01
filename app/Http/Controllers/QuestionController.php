<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;

class QuestionController extends Controller
{
    public function index(Topic $topic) {
        $question = Question::findByTopic($topic);
        return view('question.index')
                ->with('question', $question);
    }

    public function save(Request $request, Question $question) {
        // Save the answer
        // Get the next question
        // return redirect()->route('question.index', ['question' => $question->nextQuestionID]);
    }
}
