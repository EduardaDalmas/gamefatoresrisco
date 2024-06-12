<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Topic;

class QuestionController extends Controller
{
    public function save(Request $request, Topic $topic) {
        $question = new Question();
        $question->topic()->associate($topic);
        $question->description = $request->pergunta;
        $question->save();
        return redirect()->route('topic.edit', ['topic' => $topic]);
    }

    public function view(Question $question) {
        return view('question.view')
            ->with('question', $question)
            ->with('options', $question->options()->withTrashed()->get());
    }

    public function delete(Question $question) {
        $topic = $question->topic;
        $question->delete();
        return redirect()->route('topic.edit', ['topic' => $topic]);
    }

    public function restore($question_id) {
        $question = Question::withTrashed()->find($question_id);
        $question->restore();
        return redirect()->route('topic.edit', ['topic' => $question->topic]);
    }
}
