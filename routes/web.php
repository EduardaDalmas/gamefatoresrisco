<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

use App\Http\Controllers\GameController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResponseAjaxController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('login') ->get('/login',  [HomeController::class, 'login']);
Route::name('logout')->get('/logout', [HomeController::class, 'logout']);
Auth::routes();



Route::middleware(['web', 'auth'])->group(function () {
    Route::name('home')->get('/', [HomeController::class, 'index']);

    Route::name('response.')->prefix('response')->group(function () {
        Route::name('ajax.')->prefix('ajax')->group(function () {
            Route::name('question')->post('question', [ResponseAjaxController::class, 'question']);
        });
        Route::name('topic')   ->get('questionnaire/{questionnaire}', [ResponseController::class, 'topic']);
        Route::name('question')->get('topic/{topic}',                 [ResponseController::class, 'question']);
    });



    // Route::get('/game', [Controllers\GameController::class, 'index'])->name('game');

    // Route::get('/question/{question}', [App\Http\Controllers\QuestionController::class, 'index'])->name('question');


    // Route::get('/questionnaire', [App\Http\Controllers\QuestionnaireController::class, 'index'])->name('questionnaire');


    // Route::name('questionnaire.')->prefix('questionnaire')->group(function () {
    //     Route::name('index')->get('/', [QuestionnaireController::class, 'index']);
    //     Route::name('save') ->get('/', [QuestionnaireController::class, 'save']);

    // });

    // Route::name('topic.')->prefix('topic')->group(function () {
    //     Route::name('index')->get('/', function () {
    //         return redirect()->route('questionnaire.index');
    //     });

    //     Route::name('index')->get('/{questionnaire}/questionnaire', [TopicController::class, 'index']);
    // });

    // Route::name('question.')->prefix('question')->group(function () {
    //     Route::name('index')->get('/', function () {
    //         return redirect()->route('questionnaire.index');
    //     });
    //     Route::name('view')->get('topic/{topic}',    [QuestionController::class, 'view']);
    //     Route::name('save')->post('{question}/save', [QuestionController::class, 'save']);
    // });
});





