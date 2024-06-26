<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\Topic;
use App\Models\Media;

class TopicController extends Controller
{
    public function index(Questionnaire $questionnaire)
    {
        return redirect()
            ->route('question.index', [
                'topic' => $questionnaire->topics->fristOrFail()
            ]);
    }

    public function edit(Topic $topic){
        return view('topic.edit')
            ->with('topic', $topic)
            ->with('questions', $topic->questions()->withTrashed()->get())
            ->with('myMedia', Media::getByOwner());
    }

    public function delete(Topic $topic){
        $topic->delete();
        return redirect()
            ->route('questionnaire.edit', [
                'questionnaire' => $topic->questionnaire->id
            ]);
    }

}
