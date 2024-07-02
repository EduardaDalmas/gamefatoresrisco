<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\Team;
use App\Services\Reports\QuantityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    function index(){
        return view('dashboard.index')
            ->with('questionnaires', Questionnaire::getByOwner());
    }
    public function questionnaire(Questionnaire $questionnaire, Team $team)
    {
        $service = new QuantityService($questionnaire);

        dd($service->get());


    }

    public function team(Questionnaire $questionnaire, Team $team)
    {
        $service = new QuantityService($questionnaire, $team);

        dd($service->get());


    }
}
