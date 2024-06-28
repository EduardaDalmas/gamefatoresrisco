<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function save(Request $request, Question $question) {
        $option = new Option();
        $option->question()->associate($question);
        $option->description = $request->resposta;
        $option->name = $request->nomeOpcao;
        $option->save();
        return redirect()->route('question.view', ['question' => $question]);
    }

    public function delete(Option $option) {
        $question = $option->question;
        $option->delete();
        return redirect()->route('question.view', ['question' => $question]);
    }

    public function restore($option) {
        $option = Option::withTrashed()->find($option);
        $option->restore();
        return redirect()->route('question.view', ['question' => $option->question]);
    }
}
