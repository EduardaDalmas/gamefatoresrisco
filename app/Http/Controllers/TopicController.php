<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;

class TopicController extends Controller
{
    public function index(Questionnaire $questionnaire)
    {
        return redirect()->route('question.index', ['topic' => $Questionnaire->topics->fristOrFail()]);
    }
}
