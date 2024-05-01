<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Questionnaire;
use App\Models\Topic;

class ResponseController extends Controller
{
    public function topic(Questionnaire $questionnaire)
    {
        $topics = $questionnaire->getOpenTopics();
        $count = $topics->count();

        if($count == 1){
            return redirect()
                ->route('response.question', ['topic' => $topics->first()->id]);
        }else if($count > 1){
            return view('response.topics')
                ->with('topics', $topics);
        }else{
            return redirect()
                ->route('home')
                ->withErrors(['message' => 'Nenhum Tema cadastrado!']);
        }
        
    }

    public function question(Topic $topic)
    {
        $question = $topic->getCurrentQuestion();
        if ($question == null) {
            return redirect()
                ->route('response.topic', ['questionnaire' => $topic->questionnaire]);
        } 
        return view('response.questions')
                ->with('question', $question);        
    }
}
