<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \Exception;

use App\Models\Answer;
use App\Models\Option;
class ResponseAjaxController extends Controller
{
    public function question(Request $request)
    {
        try {
            $option = Option::findOrFail($request->option_id);
            $person = Auth::user()->person;

            $answer = new Answer();
            $answer->option()->associate($option);
            $answer->person()->associate($person);
            $answer->save();

            $route = route('response.question', ['topic' => $option->question->topic]);

            return response()->json($route, 200);

        } catch (Exception $e) {
            $response['success'] = false;
            if(env('APP_ENV') !== 'production'){
                $response['message'] = $e->getMessage();
            }
            return response()->json($response, 500);
        }
    }
}
