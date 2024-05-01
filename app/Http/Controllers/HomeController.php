<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Questionnaire;

class HomeController extends Controller
{
    public function index() {
        return view('home')
            ->with('questionnaires', Questionnaire::getOpenedsCurrentUser());
    }

    public function login() {
        return view('auth.login');
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('login');
    }
}
