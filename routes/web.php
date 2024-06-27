<?php

use App\Http\Controllers\OptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResponseAjaxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\TeamsController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::name('login') ->get('/login',  [HomeController::class, 'login']);
Auth::routes();
Route::name('goout') ->get('/goout',  [HomeController::class, 'logout']);

Route::middleware(['web', 'auth'])->group(function () {
    Route::name('home')->get('/', [HomeController::class, 'index']);

    Route::name('response.')->prefix('response')->group(function () {
        Route::name('ajax.')->prefix('ajax')->group(function () {
            Route::name('question')->post('question', [ResponseAjaxController::class, 'question']);
        });
        Route::name('topic')   ->get('questionnaire/{questionnaire}', [ResponseController::class, 'topic']);
        Route::name('question')->get('topic/{topic}',                 [ResponseController::class, 'question']);
        Route::name('finish')->get('finish',                          [ResponseController::class, 'finish']);
    });

    Route::post('/upload/video', [MediaController::class, 'videoUpload'])->name('media.video.upload');
    Route::post('/upload/image', [MediaController::class, 'imageUpload'])->name('media.image.upload');
    Route::post('/upload/video_url', [MediaController::class, 'videoUrlUpload'])->name('media.video.url.upload');
    Route::post('/upload/image_url', [MediaController::class, 'imageUrlUpload'])->name('media.image.url.upload');


    Route::get(('/answers/{questionnaire}'), [AnswerController::class, 'index'])->name('answer.index');
    Route::get(('/answers/questionnaire/{person}/{questionnaire}'), [AnswerController::class, 'show'])->name('answer.show');


    Route::name('questionnaire.')->prefix('questionnaire')->group(callback: function () {
        Route::name('create')->get('create',                 [QuestionnaireController::class, 'create']);
        Route::name('save')  ->post('save',                  [QuestionnaireController::class, 'save']);
        Route::name('view')  ->get('{questionnaire}',        [QuestionnaireController::class, 'view']);
        Route::name('edit')  ->get('{questionnaire}/edit',   [QuestionnaireController::class, 'edit']);
        Route::name('update')->put('{questionnaire}/update', [QuestionnaireController::class, 'update']);
        Route::name('delete')->get('{questionnaire}/delete', [QuestionnaireController::class, 'delete']);
    });

    Route::name('topic.')->prefix('topic')->group(callback: function () {
        Route::name('view')  ->get('{topic}',        [HomeController::class, 'emDesenv']);
        Route::name('edit')  ->get('{topic}/edit',   [TopicController::class, 'edit']);
        Route::name('update')->put('{topic}/update', [TopicController::class, 'update']);
        Route::name('delete')->get('{topic}/delete', [TopicController::class, 'delete']);
    });

    Route::name('question.')->prefix('question')->group(callback: function () {
        Route::name('save')   ->post('save/topic/{topic}', [QuestionController::class, 'save']);
        Route::name('view')   ->get('{question}',          [QuestionController::class, 'view']);
        Route::name('update') ->put('{question}/update',   [QuestionController::class, 'update']);
        Route::name('restore')->get('{question}/restore',  [QuestionController::class, 'restore']);
        Route::name('delete') ->get('{question}/delete',   [QuestionController::class, 'delete']);
    });

    Route::name('option.')->prefix('option')->group(callback: function () {
        Route::name('save')   ->post('save/question/{question}', [OptionController::class, 'save']);
        Route::name('restore')->get('{option}/restore',          [OptionController::class, 'restore']);
        Route::name('delete') ->get('{option}/delete',           [OptionController::class, 'delete']);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('/password/update', [PasswordController::class, 'update'])->name('password.update');

    Route::name('teams.')->prefix('teams')->group(callback: function () {
        Route::name('index')->get('index',                   [TeamsController::class, 'index']);
        Route::name('show')->get('{team}',                     [TeamsController::class, 'show']);
    });

});





