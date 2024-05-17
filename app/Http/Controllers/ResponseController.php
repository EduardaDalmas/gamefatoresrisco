<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\Questionnaire;
use App\Models\Topic;

class ResponseController extends Controller
{
    public function topic(Request $request, Questionnaire $questionnaire)
    {
        $previousUrl = Redirect::back()->getTargetUrl();
        $topics = $questionnaire->getOpenTopics();
        $count = $topics->count();

        if($count == 1){
            return redirect()
                ->route('response.question', ['topic' => $topics->first()->id]);
        }else if($count > 1){
            return view('response.topics')
                ->with('topics', $topics);
        }else{
            if (strpos($previousUrl, 'topic') !== false) {
                return redirect()
                    ->route('response.finish')
                    ->withErrors(['message' => 'Nenhum Tema cadastrado!']);
            } else {
                return redirect()
                    ->route('home')
                    ->withErrors(['message' => 'Questionário já respondido!']);
            }
        }
        
    }

    public function question(Topic $topic)
    {
        $question = $topic->getCurrentQuestion();
        if ($question == null) {
            return redirect()
                ->route('response.topic', ['questionnaire' => $topic->questionnaire]);
                // return redirect()->route('response.finish');
        } 
        return view('response.questions')
                ->with('question', $question);        
    }

    public function finish()
    {
        return view('response.finish');
    }
}
