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
    //     $question = $topic->getCurrentQuestion();
    //     if ($question == null) {
    //         return redirect()
    //             ->route('response.topic', ['questionnaire' => $topic->questionnaire]);
    //             // return redirect()->route('response.finish');
    //     } 
    //     return view('response.questions')
    //             ->with('question', $question);        
    // }

    $question = $topic->getCurrentQuestion();
        if ($question == null) {
            return redirect()->route('response.topic', ['questionnaire' => $topic->questionnaire]);
        } 
        
        // Geração do HTML da mídia
        $mediaHtml = '';
        if ($question->media) {
            if ($question->media->type == 'image') {
                $mediaHtml = '<img src="' . asset('images/' . $question->media->media_path) . '" class="card-img-top img-question" alt="...">';
            } elseif ($question->media->type == 'image_url') {
                $mediaHtml = '<img src="' . asset($question->media->media_path) . '" class="card-img-top img-question" alt="...">';
            } elseif ($question->media->type == 'video_file') {
                $mediaHtml = '
                <div class="video-container">
                    <video id="my-video" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width="640" height="360">
                        <source src="' . asset('videos/' . $question->media->media_path) . '" type="video/mp4">
                    </video>
                </div>';
            } elseif ($question->media->type == 'video_url') {
                $mediaHtml = '
                    <div class="video-container">
                        <iframe width="560" height="315" src="' . $question->media->media_path . '" frameborder="0" allowfullscreen></iframe>
                    </div>';
            }
        }

        return view('response.questions')
                ->with('question', $question)
                ->with('mediaHtml', $mediaHtml);        
    }

    public function finish()
    {
        return view('response.finish');
    }
}
